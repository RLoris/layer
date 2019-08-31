<?php
/**
 * Created by IntelliJ IDEA.
 * User: Home
 * Date: 17-12-18
 * Time: 16:26
 */

namespace layer\core\http;


interface IHttpHeaders
{
        const Accept = "Accept";
        const Accept_Charset = "Accept-Charset";
        const Accept_Encoding = "Accept-Encoding";
        const Accept_Language = "Accept-Language";
        const Accept_Ranges = "Accept-Ranges";
        const Access_Control_Allow_Credentials = "Access-Control-Allow-Credentials";
        const Access_Control_Allow_Headers = "Access-Control-Allow-Headers";
        const Access_Control_Allow_Methods = "Access-Control-Allow-Methods";
        const Access_Control_Allow_Origin = "Access-Control-Allow-Origin";
        const Access_Control_Expose_Headers = "Access-Control-Expose-Headers";
        const Access_Control_Max_Age = "Access-Control-Max-Age";
        const Access_Control_Request_Headers = "Access-Control-Request-Headers";
        const Access_Control_Request_Method = "Access-Control-Request-Method";
        const Age = "Age";
        const Allow = "Allow";
        const Alt_Svc = "Alt-Svc";
        const Authorization = "Authorization";
        const Cache_Control = "Cache-Control";
        const Clear_Site_Data = "Clear-Site-Data";
        const Connection = "Connection";
        const Content_Disposition = "Content-Disposition";
        const Content_Encoding = "Content-Encoding";
        const Content_Language = "Content-Language";
        const Content_Length = "Content-Length";
        const Content_Location = "Content-Location";
        const Content_Range = "Content-Range";
        const Content_Security_Policy = "Content-Security-Policy";
        const Content_Security_Policy_Report_Only = "Content-Security-Policy-Report-Only";
        const Content_Type = "Content-Type";
        const Cookie = "Cookie";
        const Cookie2 = "Cookie2";
        const DNT = "DNT";
        const Date = "Date";
        const ETag = "ETag";
        const Early_Data = "Early-Data";
        const Expect = "Expect";
        const Expect_CT = "Expect-CT";
        const Expires = "Expires";
        const Feature_Policy = "Feature-Policy";
        const Forwarded = "Forwarded";
        const From = "From";
        const Host = "Host";
        const If_Match = "If-Match";
        const If_Modified_Since = "If-Modified-Since";
        const If_None_Match = "If-None-Match";
        const If_Range = "If-Range";
        const If_Unmodified_Since = "If-Unmodified-Since";
        const Index = "Index";
        const Keep_Alive = "Keep-Alive";
        const Large_Allocation = "Large-Allocation";
        const Last_Modified = "Last-Modified";
        const Location = "Location";
        const Origin = "Origin";
        const Pragma = "Pragma";
        const Proxy_Authenticate = "Proxy-Authenticate";
        const Proxy_Authorization = "Proxy-Authorization";
        const Public_Key_Pins = "Public-Key-Pins";
        const Public_Key_Pins_Report_Only = "Public-Key-Pins-Report-Only";
        const Range = "Range";
        const Referer = "Referer";
        const Referrer_Policy = "Referrer-Policy";
        const Retry_After = "Retry-After";
        const Sec_WebSocket_Accept = "Sec-WebSocket-Accept";
        const Server = "Server";
        const Server_Timing = "Server-Timing";
        const Set_Cookie = "Set-Cookie";
        const Set_Cookie2 = "Set-Cookie2";
        const SourceMap = "SourceMap";
        const Strict_Transport_Security = "Strict-Transport-Security";
        const TE = "TE";
        const Timing_Allow_Origin = "Timing-Allow-Origin";
        const Tk = "Tk";
        const Trailer = "Trailer";
        const Transfer_Encoding = "Transfer-Encoding";
        const Upgrade_Insecure_Requests = "Upgrade-Insecure-Requests";
        const User_Agent = "User-Agent";
        const Vary = "Vary";
        const Via = "Via";
        const WWW_Authenticate = "WWW-Authenticate";
        const Warning = "Warning";
        const X_Content_Type_Options = "X-Content-Type-Options";
        const X_DNS_Prefetch_Control = "X-DNS-Prefetch-Control";
        const X_Forwarded_For = "X-Forwarded-For";
        const X_Forwarded_Host = "X-Forwarded-Host";
        const X_Forwarded_Proto = "X-Forwarded-Proto";
        const X_Frame_Options = "X-Frame-Options";
        const X_XSS_Protection = "X-XSS-Protection";
}