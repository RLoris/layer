<?php

namespace layer\core\manager;

use layer\core\config\Configuration;
use layer\core\html\Script;
use layer\core\html\Style;
use layer\core\mvc\view\Layout;
use layer\core\mvc\view\View;

class ViewManager
{
    /**
     * @var string $viewDirectory
     */
    private $viewDirectory;
    /**
     * @var string $layoutName
     */
    private $layoutName;
    /**
     * @var string[] $beforeViews
     */
    private $beforeViews;
    /**
     * @var string $contentView
     */
    private $contentView;
    /**
     * @var string[] $afterViews
     */
    private $afterViews;
    /**
     * @var string[]
     */
    private $views;
    /**
     * @var Style[]
     */
    private $styles;
    /**
     * @var Script[]
     */
    private $scripts;

    public function __construct($views)
    {
        $this->views = $views;
    }

    public function setBase($baseDirectory) {
        $this->viewDirectory = dirname($baseDirectory)."/view";
        $this->styles = [];
        $this->scripts = [];
        $this->afterViews = [];
        $this->beforeViews = [];
    }

    private function loadLayout($layoutName)
    {
        if($layoutName && Configuration::get("layouts/$layoutName", false))
        {
            $this->layoutName = $layoutName;
            $this->beforeViews = Configuration::get("layouts/$layoutName/before", false);
            $this->afterViews = Configuration::get("layouts/$layoutName/after", false);
            return true;
        }
        return false;
    }
    /**
     * @return string
     */
    public function getLayoutName(): string
    {
        return $this->layoutName;
    }

    /**
     * @param string $layoutName
     * @return bool
     */
    public function setLayoutName($layoutName)
    {
        return $this->loadLayout($layoutName);
    }

    public function addBeforeView($viewName, $position = null)
    {
        if($this->sharedViewExists($viewName))
        {
            if($position)
            {
                $this->beforeViews[$position] = $viewName;
            }
            else
            {
                $this->beforeViews[] = $viewName;
            }
            return true;
        }
        return false;
    }

    public function removeBeforeView($viewName)
    {
        $idx = array_search($viewName, $this->beforeViews);
        if($idx)
        {
            array_splice($this->beforeViews, $idx, 1);
            return true;
        }
        return false;
    }

    /**
     * @return string[]
     */
    public function getBeforeViews(): array
    {
        return $this->beforeViews;
    }

    /**
     * @return string
     */
    public function getContentView(): string
    {
        return $this->contentView;
    }

    /**
     * @param string $contentView
     * @return bool
     */
    public function setContentView($contentView)
    {
        if($contentView && file_exists($this->viewDirectory."/$contentView.php"))
        {
            $this->contentView = $contentView;
            return true;
        }
        return false;
    }

    public function addAfterView($viewName, $position = null)
    {
        if($this->sharedViewExists($viewName))
        {
            if($position)
            {
                $this->afterViews[$position] = $viewName;
            }
            else
            {
                $this->afterViews[] = $viewName;
            }
            return true;
        }
        return false;
    }

    public function removeAfterView($viewName)
    {
        $idx = array_search($viewName, $this->afterViews);
        if($idx)
        {
            array_splice($this->afterViews, $idx, 1);
            return true;
        }
        return false;
    }
    /**
     * @return string[]
     */
    public function getAfterViews(): array
    {
        return $this->afterViews;
    }

    private function sharedViewExists($viewName)
    {
        if(array_key_exists($viewName, $this->views) && file_exists($this->views[$viewName]))
        {
            return true;
        }
        return false;
    }

    public function render($data = [])
    {
        $layout = new Layout();
        foreach ($this->beforeViews as $view)
        {
            $layout->appendView(new View($this->views[$view]));
        }
        if($this->contentView)
            $layout->appendView(new View($this->viewDirectory."/".$this->contentView.".php"));
        foreach ($this->afterViews as $view)
        {
            $layout->appendView(new View($this->views[$view]));
        }

        return $layout->render(
            array_merge($data,
            [
                "__scripts" => implode("",array_map(function (Script $script) { return $script->render(); }, $this->scripts)),
                "__styles" => implode("",array_map(function (Style $style) { return $style->render(); }, $this->styles))
            ]
        ));
    }

    public function addStyle(Style $style)
    {
        if(!in_array($style, $this->styles, true))
        {
            $this->styles[] = $style;
        }
    }

    public function addScript(Script $script)
    {
        if(!in_array($script, $this->scripts, true))
        {
            $this->scripts[] = $script;
        }
    }

    public function getStyles()
    {
        return $this->styles;
    }

    public function getScripts()
    {
        return $this->scripts;
    }
}