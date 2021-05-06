<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <title>EQUATORIAL Documentation</title>

    <link href="https://fonts.googleapis.com/css?family=PT+Sans&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/style.css") }}" media="screen" />
        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/print.css") }}" media="print" />
        <script src="{{ asset("vendor/scribe/js/all.js") }}"></script>

        <link rel="stylesheet" href="{{ asset("vendor/scribe/css/highlight-darcula.css") }}" media="" />
        <script src="{{ asset("vendor/scribe/js/highlight.pack.js") }}"></script>
    <script>hljs.initHighlightingOnLoad();</script>

</head>

<body class="" data-languages="[&quot;bash&quot;,&quot;javascript&quot;]">
<a href="#" id="nav-button">
      <span>
        NAV
            <img src="{{ asset("vendor/scribe/images/navbar.png") }}" alt="-image" class=""/>
      </span>
</a>
<div class="tocify-wrapper">
                <div class="lang-selector">
                            <a href="#" data-language-name="bash">bash</a>
                            <a href="#" data-language-name="javascript">javascript</a>
                    </div>
        <div class="search">
        <input type="text" class="search" id="input-search" placeholder="Search">
    </div>
    <ul class="search-results"></ul>

    <ul id="toc">
    </ul>

            <ul class="toc-footer" id="toc-footer">
                            <li><a href="{{ route("scribe.postman") }}">View Postman collection</a></li>
                            <li><a href="{{ route("scribe.openapi") }}">View OpenAPI (Swagger) spec</a></li>
                            <li><a href='http://github.com/knuckleswtf/scribe'>Documentation powered by Scribe ✍</a></li>
                    </ul>
            <ul class="toc-footer" id="last-updated">
            <li>Last updated: April 18 2021</li>
        </ul>
</div>
<div class="page-wrapper">
    <div class="dark-box"></div>
    <div class="content">
        <h1>Introduction</h1>
<p>EQUATORIAL NUTS BUYER APP APIs</p>
<p>This documentation aims to provide all the information you need to work with our API.</p>
<aside>As you scroll, you'll see code examples for working with the API in different programming languages in the dark area to the right (or as part of the content on mobile).
You can switch the language used with the tabs at the top right (or from the nav menu at the top left on mobile).</aside>
<script src="https://cdn.jsdelivr.net/npm/lodash@4.17.10/lodash.min.js"></script>
<script>
    var baseUrl = "http://localhost";
</script>
<script src="{{ asset("vendor/scribe/js/tryitout-2.5.3.js") }}"></script>
<blockquote>
<p>Base URL</p>
</blockquote>
<pre><code class="language-yaml">http://localhost</code></pre><h1>Authenticating requests</h1>
<p>This API is not authenticated.</p><h1>B2C Disbursement</h1>
<p>API for Disbursing funds to a registered farmer</p>
<h2>Initiate a Disbursement Request</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/initiate-mpesa-disbursement" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"order_id":"at"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/initiate-mpesa-disbursement"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "order_id": "at"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-initiate-mpesa-disbursement" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-initiate-mpesa-disbursement"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-initiate-mpesa-disbursement"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-initiate-mpesa-disbursement" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-initiate-mpesa-disbursement"></code></pre>
</div>
<form id="form-POSTapi-v1-initiate-mpesa-disbursement" data-method="POST" data-path="api/v1/initiate-mpesa-disbursement" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-initiate-mpesa-disbursement', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-initiate-mpesa-disbursement" onclick="tryItOut('POSTapi-v1-initiate-mpesa-disbursement');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-initiate-mpesa-disbursement" onclick="cancelTryOut('POSTapi-v1-initiate-mpesa-disbursement');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-initiate-mpesa-disbursement" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/initiate-mpesa-disbursement</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-initiate-mpesa-disbursement" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-initiate-mpesa-disbursement" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>order_id</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="order_id" data-endpoint="POSTapi-v1-initiate-mpesa-disbursement" data-component="body" required  hidden>
<br>
Order id.
</p>

</form><h1>Bag Types</h1>
<p>API for fetching Bag Types</p>
<h2>List Bag Types</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/bag-types" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/bag-types"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-bag-types" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-bag-types"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-bag-types"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-bag-types" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-bag-types"></code></pre>
</div>
<form id="form-POSTapi-v1-bag-types" data-method="POST" data-path="api/v1/bag-types" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-bag-types', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-bag-types" onclick="tryItOut('POSTapi-v1-bag-types');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-bag-types" onclick="cancelTryOut('POSTapi-v1-bag-types');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-bag-types" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/bag-types</code></b>
</p>
</form><h1>Endpoints</h1>
<h2>api/v1/mpesa-account-balance/result</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/mpesa-account-balance/result" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/mpesa-account-balance/result"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-mpesa-account-balance-result" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-mpesa-account-balance-result"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-mpesa-account-balance-result"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-mpesa-account-balance-result" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-mpesa-account-balance-result"></code></pre>
</div>
<form id="form-POSTapi-v1-mpesa-account-balance-result" data-method="POST" data-path="api/v1/mpesa-account-balance/result" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-mpesa-account-balance-result', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-mpesa-account-balance-result" onclick="tryItOut('POSTapi-v1-mpesa-account-balance-result');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-mpesa-account-balance-result" onclick="cancelTryOut('POSTapi-v1-mpesa-account-balance-result');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-mpesa-account-balance-result" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/mpesa-account-balance/result</code></b>
</p>
</form>
<h2>api/v1/mpesa-account-balance/timeout</h2>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/mpesa-account-balance/timeout" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/mpesa-account-balance/timeout"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-mpesa-account-balance-timeout" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-mpesa-account-balance-timeout"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-mpesa-account-balance-timeout"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-mpesa-account-balance-timeout" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-mpesa-account-balance-timeout"></code></pre>
</div>
<form id="form-POSTapi-v1-mpesa-account-balance-timeout" data-method="POST" data-path="api/v1/mpesa-account-balance/timeout" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-mpesa-account-balance-timeout', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-mpesa-account-balance-timeout" onclick="tryItOut('POSTapi-v1-mpesa-account-balance-timeout');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-mpesa-account-balance-timeout" onclick="cancelTryOut('POSTapi-v1-mpesa-account-balance-timeout');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-mpesa-account-balance-timeout" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/mpesa-account-balance/timeout</code></b>
</p>
</form><h1>Farmers</h1>
<h2>Display a listing of the resource.</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/farmers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/farmers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<div id="execution-results-GETapi-v1-farmers" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-farmers"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-farmers"></code></pre>
</div>
<div id="execution-error-GETapi-v1-farmers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-farmers"></code></pre>
</div>
<form id="form-GETapi-v1-farmers" data-method="GET" data-path="api/v1/farmers" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-farmers', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-farmers" onclick="tryItOut('GETapi-v1-farmers');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-farmers" onclick="cancelTryOut('GETapi-v1-farmers');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-farmers" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/farmers</code></b>
</p>
<p>
<label id="auth-GETapi-v1-farmers" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-farmers" data-component="header"></label>
</p>
</form>
<h2>Store a newly created resource in storage.</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/farmers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"full_name":"assumenda","phone_number":"facere","id_number":"molestiae","gender":"voluptas","date_of_birth":"sed","region_id":5,"raw_material_ids":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/farmers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "full_name": "assumenda",
    "phone_number": "facere",
    "id_number": "molestiae",
    "gender": "voluptas",
    "date_of_birth": "sed",
    "region_id": 5,
    "raw_material_ids": []
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-farmers" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-farmers"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-farmers"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-farmers" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-farmers"></code></pre>
</div>
<form id="form-POSTapi-v1-farmers" data-method="POST" data-path="api/v1/farmers" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-farmers', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-farmers" onclick="tryItOut('POSTapi-v1-farmers');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-farmers" onclick="cancelTryOut('POSTapi-v1-farmers');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-farmers" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/farmers</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-farmers" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-farmers" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>full_name</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="full_name" data-endpoint="POSTapi-v1-farmers" data-component="body" required  hidden>
<br>
Full Name.
</p>
<p>
<b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone_number" data-endpoint="POSTapi-v1-farmers" data-component="body" required  hidden>
<br>
PhoneNumber '254*********'.
</p>
<p>
<b><code>id_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="id_number" data-endpoint="POSTapi-v1-farmers" data-component="body" required  hidden>
<br>
ID Number.
</p>
<p>
<b><code>gender</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="gender" data-endpoint="POSTapi-v1-farmers" data-component="body" required  hidden>
<br>
MALE/FEMALE.
</p>
<p>
<b><code>date_of_birth</code></b>&nbsp;&nbsp;<small>date</small>  &nbsp;
<input type="text" name="date_of_birth" data-endpoint="POSTapi-v1-farmers" data-component="body" required  hidden>
<br>
Date of Birth.
</p>
<p>
<b><code>region_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="region_id" data-endpoint="POSTapi-v1-farmers" data-component="body" required  hidden>
<br>
Region ID.
</p>
<p>
<b><code>raw_material_ids</code></b>&nbsp;&nbsp;<small>object</small>  &nbsp;
<input type="text" name="raw_material_ids" data-endpoint="POSTapi-v1-farmers" data-component="body" required  hidden>
<br>
Array of Raw Material IDs.
</p>

</form>
<h2>Display the specified resource.</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X GET \
    -G "http://localhost/api/v1/farmers/6" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/farmers/6"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers,
}).then(response =&gt; response.json());</code></pre>
<blockquote>
<p>Example response (401):</p>
</blockquote>
<pre><code class="language-json">{
    "message": "Unauthenticated."
}</code></pre>
<div id="execution-results-GETapi-v1-farmers--farmer-" hidden>
    <blockquote>Received response<span id="execution-response-status-GETapi-v1-farmers--farmer-"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-GETapi-v1-farmers--farmer-"></code></pre>
</div>
<div id="execution-error-GETapi-v1-farmers--farmer-" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-GETapi-v1-farmers--farmer-"></code></pre>
</div>
<form id="form-GETapi-v1-farmers--farmer-" data-method="GET" data-path="api/v1/farmers/{farmer}" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('GETapi-v1-farmers--farmer-', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-GETapi-v1-farmers--farmer-" onclick="tryItOut('GETapi-v1-farmers--farmer-');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-GETapi-v1-farmers--farmer-" onclick="cancelTryOut('GETapi-v1-farmers--farmer-');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-GETapi-v1-farmers--farmer-" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-green">GET</small>
 <b><code>api/v1/farmers/{farmer}</code></b>
</p>
<p>
<label id="auth-GETapi-v1-farmers--farmer-" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="GETapi-v1-farmers--farmer-" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>URL Parameters</b></h4>
<p>
<b><code>farmer</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="farmer" data-endpoint="GETapi-v1-farmers--farmer-" data-component="url" required  hidden>
<br>
Farmer Id
</p>
</form>
<h2>Search For a Farmer</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Query can be: Phone Number, Full Name or Id Number</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/farmers-search" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"search_query":"neque"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/farmers-search"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "search_query": "neque"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-farmers-search" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-farmers-search"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-farmers-search"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-farmers-search" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-farmers-search"></code></pre>
</div>
<form id="form-POSTapi-v1-farmers-search" data-method="POST" data-path="api/v1/farmers-search" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-farmers-search', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-farmers-search" onclick="tryItOut('POSTapi-v1-farmers-search');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-farmers-search" onclick="cancelTryOut('POSTapi-v1-farmers-search');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-farmers-search" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/farmers-search</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-farmers-search" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-farmers-search" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>search_query</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="search_query" data-endpoint="POSTapi-v1-farmers-search" data-component="body" required  hidden>
<br>
Search Query.
</p>

</form>
<h2>Filter Farmers by region</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Gets Farmers within a specified region</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/farmers-region-filter" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"region_id":12}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/farmers-region-filter"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "region_id": 12
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-farmers-region-filter" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-farmers-region-filter"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-farmers-region-filter"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-farmers-region-filter" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-farmers-region-filter"></code></pre>
</div>
<form id="form-POSTapi-v1-farmers-region-filter" data-method="POST" data-path="api/v1/farmers-region-filter" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-farmers-region-filter', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-farmers-region-filter" onclick="tryItOut('POSTapi-v1-farmers-region-filter');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-farmers-region-filter" onclick="cancelTryOut('POSTapi-v1-farmers-region-filter');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-farmers-region-filter" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/farmers-region-filter</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-farmers-region-filter" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-farmers-region-filter" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>region_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="region_id" data-endpoint="POSTapi-v1-farmers-region-filter" data-component="body" required  hidden>
<br>
Search Query.
</p>

</form>
<h2>Verify Farmer&#039;s Phone Number</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/farmers-verify-phone-number" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"farmer_id":3,"passcode":16}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/farmers-verify-phone-number"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "farmer_id": 3,
    "passcode": 16
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-farmers-verify-phone-number" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-farmers-verify-phone-number"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-farmers-verify-phone-number"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-farmers-verify-phone-number" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-farmers-verify-phone-number"></code></pre>
</div>
<form id="form-POSTapi-v1-farmers-verify-phone-number" data-method="POST" data-path="api/v1/farmers-verify-phone-number" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-farmers-verify-phone-number', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-farmers-verify-phone-number" onclick="tryItOut('POSTapi-v1-farmers-verify-phone-number');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-farmers-verify-phone-number" onclick="cancelTryOut('POSTapi-v1-farmers-verify-phone-number');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-farmers-verify-phone-number" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/farmers-verify-phone-number</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-farmers-verify-phone-number" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-farmers-verify-phone-number" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>farmer_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="farmer_id" data-endpoint="POSTapi-v1-farmers-verify-phone-number" data-component="body" required  hidden>
<br>
Farmer's id received after successful registration.
</p>
<p>
<b><code>passcode</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="passcode" data-endpoint="POSTapi-v1-farmers-verify-phone-number" data-component="body" required  hidden>
<br>
OTP.
</p>

</form>
<h2>Resend OTP</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/farmers-resend-otp" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"farmer_id":4}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/farmers-resend-otp"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "farmer_id": 4
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-farmers-resend-otp" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-farmers-resend-otp"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-farmers-resend-otp"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-farmers-resend-otp" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-farmers-resend-otp"></code></pre>
</div>
<form id="form-POSTapi-v1-farmers-resend-otp" data-method="POST" data-path="api/v1/farmers-resend-otp" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-farmers-resend-otp', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-farmers-resend-otp" onclick="tryItOut('POSTapi-v1-farmers-resend-otp');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-farmers-resend-otp" onclick="cancelTryOut('POSTapi-v1-farmers-resend-otp');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-farmers-resend-otp" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/farmers-resend-otp</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-farmers-resend-otp" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-farmers-resend-otp" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>farmer_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="farmer_id" data-endpoint="POSTapi-v1-farmers-resend-otp" data-component="body" required  hidden>
<br>
Farmer's id received after successful registration.
</p>

</form><h1>Login</h1>
<p>APIs for user authentication</p>
<h2>Login</h2>
<p>Log a user into the system. After successful login, a bearer token is returned which you may store and use for
authentication for guarded routes. Note that this token has an expiry duration therefore you should implement
a mechanism to check whether the token has expired before requiring the user to login again.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"porro","password":"quia"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "porro",
    "password": "quia"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-login" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-login"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-login"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-login" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-login"></code></pre>
</div>
<form id="form-POSTapi-v1-user-login" data-method="POST" data-path="api/v1/user/login" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-login', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-login" onclick="tryItOut('POSTapi-v1-user-login');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-login" onclick="cancelTryOut('POSTapi-v1-user-login');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-login" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/login</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>phone_number</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="phone_number" data-endpoint="POSTapi-v1-user-login" data-component="body" required  hidden>
<br>
Phone Number.
</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="password" name="password" data-endpoint="POSTapi-v1-user-login" data-component="body" required  hidden>
<br>
Password.
</p>

</form>
<h2>Verify Buyer&#039;s Login Token</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/login/verify-otp" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":13}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/login/verify-otp"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": 13
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-login-verify-otp" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-login-verify-otp"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-login-verify-otp"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-login-verify-otp" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-login-verify-otp"></code></pre>
</div>
<form id="form-POSTapi-v1-user-login-verify-otp" data-method="POST" data-path="api/v1/user/login/verify-otp" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-login-verify-otp', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-login-verify-otp" onclick="tryItOut('POSTapi-v1-user-login-verify-otp');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-login-verify-otp" onclick="cancelTryOut('POSTapi-v1-user-login-verify-otp');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-login-verify-otp" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/login/verify-otp</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-login-verify-otp" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-login-verify-otp" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>token</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="token" data-endpoint="POSTapi-v1-user-login-verify-otp" data-component="body" required  hidden>
<br>
OTP.
</p>

</form>
<h2>Resend OTP</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/login/resend-otp" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/login/resend-otp"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-login-resend-otp" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-login-resend-otp"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-login-resend-otp"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-login-resend-otp" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-login-resend-otp"></code></pre>
</div>
<form id="form-POSTapi-v1-user-login-resend-otp" data-method="POST" data-path="api/v1/user/login/resend-otp" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-login-resend-otp', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-login-resend-otp" onclick="tryItOut('POSTapi-v1-user-login-resend-otp');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-login-resend-otp" onclick="cancelTryOut('POSTapi-v1-user-login-resend-otp');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-login-resend-otp" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/login/resend-otp</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-login-resend-otp" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-login-resend-otp" data-component="header"></label>
</p>
</form><h1>Orders</h1>
<h2>List Buyer Orders (Unrefined)</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/orders"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-orders" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-orders"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-orders"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-orders" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-orders"></code></pre>
</div>
<form id="form-POSTapi-v1-orders" data-method="POST" data-path="api/v1/orders" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-orders', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-orders" onclick="tryItOut('POSTapi-v1-orders');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-orders" onclick="cancelTryOut('POSTapi-v1-orders');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-orders" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/orders</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-orders" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-orders" data-component="header"></label>
</p>
</form>
<h2>Store a newly created resource in storage.</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/orders-create-new" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"farmer_id":11,"price_list_id":2,"buying_center_id":17,"raw_material_id":12,"bag_type_id":15,"bags":1,"gross_weight":"earum","net_weight":"quas","amount":"officiis","latitude":"dolorem","longitude":"provident"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/orders-create-new"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "farmer_id": 11,
    "price_list_id": 2,
    "buying_center_id": 17,
    "raw_material_id": 12,
    "bag_type_id": 15,
    "bags": 1,
    "gross_weight": "earum",
    "net_weight": "quas",
    "amount": "officiis",
    "latitude": "dolorem",
    "longitude": "provident"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-orders-create-new" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-orders-create-new"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-orders-create-new"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-orders-create-new" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-orders-create-new"></code></pre>
</div>
<form id="form-POSTapi-v1-orders-create-new" data-method="POST" data-path="api/v1/orders-create-new" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-orders-create-new', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-orders-create-new" onclick="tryItOut('POSTapi-v1-orders-create-new');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-orders-create-new" onclick="cancelTryOut('POSTapi-v1-orders-create-new');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-orders-create-new" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/orders-create-new</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-orders-create-new" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-orders-create-new" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>farmer_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="farmer_id" data-endpoint="POSTapi-v1-orders-create-new" data-component="body" required  hidden>
<br>
Farmer id.
</p>
<p>
<b><code>price_list_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="price_list_id" data-endpoint="POSTapi-v1-orders-create-new" data-component="body" required  hidden>
<br>
Price List id used to make calculations.
</p>
<p>
<b><code>buying_center_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="buying_center_id" data-endpoint="POSTapi-v1-orders-create-new" data-component="body" required  hidden>
<br>
Buying Center id.
</p>
<p>
<b><code>raw_material_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="raw_material_id" data-endpoint="POSTapi-v1-orders-create-new" data-component="body" required  hidden>
<br>
Raw Material id.
</p>
<p>
<b><code>bag_type_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="bag_type_id" data-endpoint="POSTapi-v1-orders-create-new" data-component="body" required  hidden>
<br>
Bag Type id.
</p>
<p>
<b><code>bags</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="bags" data-endpoint="POSTapi-v1-orders-create-new" data-component="body" required  hidden>
<br>
Number of Bags Purchased.
</p>
<p>
<b><code>gross_weight</code></b>&nbsp;&nbsp;<small>numeric</small>  &nbsp;
<input type="text" name="gross_weight" data-endpoint="POSTapi-v1-orders-create-new" data-component="body" required  hidden>
<br>
Gross Weight in KGs.
</p>
<p>
<b><code>net_weight</code></b>&nbsp;&nbsp;<small>numeric</small>  &nbsp;
<input type="text" name="net_weight" data-endpoint="POSTapi-v1-orders-create-new" data-component="body" required  hidden>
<br>
Net Weight in KGs.
</p>
<p>
<b><code>amount</code></b>&nbsp;&nbsp;<small>numeric</small>  &nbsp;
<input type="text" name="amount" data-endpoint="POSTapi-v1-orders-create-new" data-component="body" required  hidden>
<br>
Total Order Amount.
</p>
<p>
<b><code>latitude</code></b>&nbsp;&nbsp;<small>numeric</small>  &nbsp;
<input type="text" name="latitude" data-endpoint="POSTapi-v1-orders-create-new" data-component="body" required  hidden>
<br>
Current Latitude.
</p>
<p>
<b><code>longitude</code></b>&nbsp;&nbsp;<small>numeric</small>  &nbsp;
<input type="text" name="longitude" data-endpoint="POSTapi-v1-orders-create-new" data-component="body" required  hidden>
<br>
Current Longitude.
</p>

</form>
<h2>Buyer Order Reports</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/order-reports" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"period":"nemo","month":"quisquam","year":"doloremque"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/order-reports"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "period": "nemo",
    "month": "quisquam",
    "year": "doloremque"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-order-reports" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-order-reports"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-order-reports"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-order-reports" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-order-reports"></code></pre>
</div>
<form id="form-POSTapi-v1-order-reports" data-method="POST" data-path="api/v1/order-reports" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-order-reports', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-order-reports" onclick="tryItOut('POSTapi-v1-order-reports');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-order-reports" onclick="cancelTryOut('POSTapi-v1-order-reports');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-order-reports" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/order-reports</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-order-reports" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-order-reports" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>period</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="period" data-endpoint="POSTapi-v1-order-reports" data-component="body" required  hidden>
<br>
Specified period: accepts weekly, monthly, yearly.
</p>
<p>
<b><code>month</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="month" data-endpoint="POSTapi-v1-order-reports" data-component="body"  hidden>
<br>
optional If monthly is specified in the period, pass the exact month and year you would want to receive dara for eg. 05-2021  defaults to the current month
</p>
<p>
<b><code>year</code></b>&nbsp;&nbsp;<small>string</small>     <i>optional</i> &nbsp;
<input type="text" name="year" data-endpoint="POSTapi-v1-order-reports" data-component="body"  hidden>
<br>
optional If yearly is specified in the period, pass the exact month and year you would want to receive dara for eg. 2021 defaults to the current year
</p>

</form><h1>Password Management</h1>
<p>APIs for user reset password</p>
<h2>Send Password Reset Token</h2>
<p>Send password reset token via Email to the user with provided email address.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/password/forgot" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"quibusdam"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/password/forgot"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "quibusdam"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-password-forgot" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-password-forgot"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-password-forgot"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-password-forgot" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-password-forgot"></code></pre>
</div>
<form id="form-POSTapi-v1-user-password-forgot" data-method="POST" data-path="api/v1/user/password/forgot" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-password-forgot', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-password-forgot" onclick="tryItOut('POSTapi-v1-user-password-forgot');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-password-forgot" onclick="cancelTryOut('POSTapi-v1-user-password-forgot');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-password-forgot" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/password/forgot</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-user-password-forgot" data-component="body" required  hidden>
<br>
Email address.
</p>

</form>
<h2>Update Password</h2>
<p>Update user's password after token verification.</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/user/password/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"molestias","token":"dicta","password":"corporis","password_confirm":"iure"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/password/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "molestias",
    "token": "dicta",
    "password": "corporis",
    "password_confirm": "iure"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-user-password-update" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-password-update"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-password-update"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-password-update" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-password-update"></code></pre>
</div>
<form id="form-POSTapi-v1-user-password-update" data-method="POST" data-path="api/v1/user/password/update" data-authed="0" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-password-update', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-password-update" onclick="tryItOut('POSTapi-v1-user-password-update');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-password-update" onclick="cancelTryOut('POSTapi-v1-user-password-update');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-password-update" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/password/update</code></b>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-user-password-update" data-component="body" required  hidden>
<br>
Email address.
</p>
<p>
<b><code>token</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="token" data-endpoint="POSTapi-v1-user-password-update" data-component="body" required  hidden>
<br>
Email token.
</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="password" name="password" data-endpoint="POSTapi-v1-user-password-update" data-component="body" required  hidden>
<br>
Password.
</p>
<p>
<b><code>password_confirm</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="password" name="password_confirm" data-endpoint="POSTapi-v1-user-password-update" data-component="body" required  hidden>
<br>
Password, must match password.
</p>

</form><h1>Raw Materials</h1>
<p>API for Raw Material Products</p>
<h2>List all Raw Materials</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/raw-materials" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/raw-materials"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-raw-materials" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-raw-materials"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-raw-materials"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-raw-materials" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-raw-materials"></code></pre>
</div>
<form id="form-POSTapi-v1-raw-materials" data-method="POST" data-path="api/v1/raw-materials" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-raw-materials', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-raw-materials" onclick="tryItOut('POSTapi-v1-raw-materials');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-raw-materials" onclick="cancelTryOut('POSTapi-v1-raw-materials');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-raw-materials" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/raw-materials</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-raw-materials" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-raw-materials" data-component="header"></label>
</p>
</form>
<h2>Fetch Raw Materials Current Price</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Returns Prices of all raw materials within the buyers specified region</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/raw-materials-prices" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/raw-materials-prices"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-raw-materials-prices" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-raw-materials-prices"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-raw-materials-prices"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-raw-materials-prices" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-raw-materials-prices"></code></pre>
</div>
<form id="form-POSTapi-v1-raw-materials-prices" data-method="POST" data-path="api/v1/raw-materials-prices" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-raw-materials-prices', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-raw-materials-prices" onclick="tryItOut('POSTapi-v1-raw-materials-prices');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-raw-materials-prices" onclick="cancelTryOut('POSTapi-v1-raw-materials-prices');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-raw-materials-prices" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/raw-materials-prices</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-raw-materials-prices" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-raw-materials-prices" data-component="header"></label>
</p>
</form>
<h2>Fetch Raw Materials Specifications</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<p>Returns Specifications of the desired Raw Material</p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/raw-materials-requirements" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"raw_material_id":3}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/raw-materials-requirements"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "raw_material_id": 3
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-raw-materials-requirements" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-raw-materials-requirements"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-raw-materials-requirements"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-raw-materials-requirements" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-raw-materials-requirements"></code></pre>
</div>
<form id="form-POSTapi-v1-raw-materials-requirements" data-method="POST" data-path="api/v1/raw-materials-requirements" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-raw-materials-requirements', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-raw-materials-requirements" onclick="tryItOut('POSTapi-v1-raw-materials-requirements');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-raw-materials-requirements" onclick="cancelTryOut('POSTapi-v1-raw-materials-requirements');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-raw-materials-requirements" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/raw-materials-requirements</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-raw-materials-requirements" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-raw-materials-requirements" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>raw_material_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="raw_material_id" data-endpoint="POSTapi-v1-raw-materials-requirements" data-component="body" required  hidden>
<br>
Raw Material ID.
</p>

</form>
<h2>Submit Raw Material Requirement Submission</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/raw-materials-requirement-submission/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"order_id":10,"submissions":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/raw-materials-requirement-submission/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "order_id": 10,
    "submissions": []
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-raw-materials-requirement-submission-create" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-raw-materials-requirement-submission-create"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-raw-materials-requirement-submission-create"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-raw-materials-requirement-submission-create" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-raw-materials-requirement-submission-create"></code></pre>
</div>
<form id="form-POSTapi-v1-raw-materials-requirement-submission-create" data-method="POST" data-path="api/v1/raw-materials-requirement-submission/create" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-raw-materials-requirement-submission-create', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-raw-materials-requirement-submission-create" onclick="tryItOut('POSTapi-v1-raw-materials-requirement-submission-create');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-raw-materials-requirement-submission-create" onclick="cancelTryOut('POSTapi-v1-raw-materials-requirement-submission-create');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-raw-materials-requirement-submission-create" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/raw-materials-requirement-submission/create</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-raw-materials-requirement-submission-create" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-raw-materials-requirement-submission-create" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>order_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="order_id" data-endpoint="POSTapi-v1-raw-materials-requirement-submission-create" data-component="body" required  hidden>
<br>
Order ID.
</p>
<p>
<b><code>submissions</code></b>&nbsp;&nbsp;<small>object</small>  &nbsp;
<input type="text" name="submissions" data-endpoint="POSTapi-v1-raw-materials-requirement-submission-create" data-component="body" required  hidden>
<br>
Array of objects containing the submissions eg. [{"raw_material_requirement_id":1, "value":0.95}, {"raw_material_requirement_id":2, "value":"spherical shapes"}].
</p>

</form>
<h2>View an Order Details + Raw Material Requirement Submissions</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/raw-materials-requirement-submission/view" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"order_id":8}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/raw-materials-requirement-submission/view"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "order_id": 8
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-raw-materials-requirement-submission-view" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-raw-materials-requirement-submission-view"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-raw-materials-requirement-submission-view"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-raw-materials-requirement-submission-view" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-raw-materials-requirement-submission-view"></code></pre>
</div>
<form id="form-POSTapi-v1-raw-materials-requirement-submission-view" data-method="POST" data-path="api/v1/raw-materials-requirement-submission/view" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-raw-materials-requirement-submission-view', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-raw-materials-requirement-submission-view" onclick="tryItOut('POSTapi-v1-raw-materials-requirement-submission-view');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-raw-materials-requirement-submission-view" onclick="cancelTryOut('POSTapi-v1-raw-materials-requirement-submission-view');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-raw-materials-requirement-submission-view" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/raw-materials-requirement-submission/view</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-raw-materials-requirement-submission-view" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-raw-materials-requirement-submission-view" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>order_id</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="order_id" data-endpoint="POSTapi-v1-raw-materials-requirement-submission-view" data-component="body" required  hidden>
<br>
Order ID.
</p>

</form><h1>Regions</h1>
<p>API for fetching Equatorial Nut Regions</p>
<h2>List Regions</h2>
<p><small class="badge badge-darkred">requires authentication</small></p>
<blockquote>
<p>Example request:</p>
</blockquote>
<pre><code class="language-bash">curl -X POST \
    "http://localhost/api/v1/regions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/regions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "POST",
    headers,
}).then(response =&gt; response.json());</code></pre>
<div id="execution-results-POSTapi-v1-regions" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-regions"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-regions"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-regions" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-regions"></code></pre>
</div>
<form id="form-POSTapi-v1-regions" data-method="POST" data-path="api/v1/regions" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-regions', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-regions" onclick="tryItOut('POSTapi-v1-regions');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-regions" onclick="cancelTryOut('POSTapi-v1-regions');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-regions" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/regions</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-regions" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-regions" data-component="header"></label>
</p>
</form>
    </div>
    <div class="dark-box">
                    <div class="lang-selector">
                                    <a href="#" data-language-name="bash">bash</a>
                                    <a href="#" data-language-name="javascript">javascript</a>
                            </div>
            </div>
</div>
<script>
    $(function () {
        var languages = ["bash","javascript"];
        setupLanguages(languages);
    });
</script>
</body>
</html>