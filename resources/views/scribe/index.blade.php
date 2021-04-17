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
            <li>Last updated: April 16 2021</li>
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
<p>This API is not authenticated.</p><h1>Farmers</h1>
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
    -d '{"full_name":"praesentium","phone_number":"animi","id_number":"quae","gender":"excepturi","date_of_birth":"rerum","region_id":9,"raw_material_ids":[]}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/farmers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "full_name": "praesentium",
    "phone_number": "animi",
    "id_number": "quae",
    "gender": "excepturi",
    "date_of_birth": "rerum",
    "region_id": 9,
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
Date of Birth.
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
    -G "http://localhost/api/v1/farmers/11" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/farmers/11"
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
    -d '{"email":"doloremque","password":"totam"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "doloremque",
    "password": "totam"
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
<b><code>email</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="text" name="email" data-endpoint="POSTapi-v1-user-login" data-component="body" required  hidden>
<br>
Email address.
</p>
<p>
<b><code>password</code></b>&nbsp;&nbsp;<small>string</small>  &nbsp;
<input type="password" name="password" data-endpoint="POSTapi-v1-user-login" data-component="body" required  hidden>
<br>
Password.
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
    -d '{"email":"molestiae"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/password/forgot"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "molestiae"
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
    -d '{"email":"odit","token":"placeat","password":"laborum","password_confirm":"sunt"}'
</code></pre>
<pre><code class="language-javascript">const url = new URL(
    "http://localhost/api/v1/user/password/update"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "email": "odit",
    "token": "placeat",
    "password": "laborum",
    "password_confirm": "sunt"
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