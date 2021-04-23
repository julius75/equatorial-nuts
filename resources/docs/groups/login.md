# Login

APIs for user authentication

## Login


Log a user into the system. After successful login, a bearer token is returned which you may store and use for
authentication for guarded routes. Note that this token has an expiry duration therefore you should implement
a mechanism to check whether the token has expired before requiring the user to login again.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/login" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"phone_number":"odit","password":"perferendis"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/login"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "phone_number": "odit",
    "password": "perferendis"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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


## Verify Buyer&#039;s Login Token

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/login/verify-OTP" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"token":7}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/login/verify-OTP"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "token": 7
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-user-login-verify-OTP" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-login-verify-OTP"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-login-verify-OTP"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-login-verify-OTP" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-login-verify-OTP"></code></pre>
</div>
<form id="form-POSTapi-v1-user-login-verify-OTP" data-method="POST" data-path="api/v1/user/login/verify-OTP" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-login-verify-OTP', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-login-verify-OTP" onclick="tryItOut('POSTapi-v1-user-login-verify-OTP');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-login-verify-OTP" onclick="cancelTryOut('POSTapi-v1-user-login-verify-OTP');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-login-verify-OTP" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/login/verify-OTP</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-login-verify-OTP" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-login-verify-OTP" data-component="header"></label>
</p>
<h4 class="fancy-heading-panel"><b>Body Parameters</b></h4>
<p>
<b><code>token</code></b>&nbsp;&nbsp;<small>integer</small>  &nbsp;
<input type="number" name="token" data-endpoint="POSTapi-v1-user-login-verify-OTP" data-component="body" required  hidden>
<br>
OTP.
</p>

</form>


## Resend OTP

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/login/resend-OTP" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/user/login/resend-OTP"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "POST",
    headers,
}).then(response => response.json());
```


<div id="execution-results-POSTapi-v1-user-login-resend-OTP" hidden>
    <blockquote>Received response<span id="execution-response-status-POSTapi-v1-user-login-resend-OTP"></span>:</blockquote>
    <pre class="json"><code id="execution-response-content-POSTapi-v1-user-login-resend-OTP"></code></pre>
</div>
<div id="execution-error-POSTapi-v1-user-login-resend-OTP" hidden>
    <blockquote>Request failed with error:</blockquote>
    <pre><code id="execution-error-message-POSTapi-v1-user-login-resend-OTP"></code></pre>
</div>
<form id="form-POSTapi-v1-user-login-resend-OTP" data-method="POST" data-path="api/v1/user/login/resend-OTP" data-authed="1" data-hasfiles="0" data-headers='{"Content-Type":"application\/json","Accept":"application\/json"}' onsubmit="event.preventDefault(); executeTryOut('POSTapi-v1-user-login-resend-OTP', this);">
<h3>
    Request&nbsp;&nbsp;&nbsp;
        <button type="button" style="background-color: #8fbcd4; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-tryout-POSTapi-v1-user-login-resend-OTP" onclick="tryItOut('POSTapi-v1-user-login-resend-OTP');">Try it out ⚡</button>
    <button type="button" style="background-color: #c97a7e; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-canceltryout-POSTapi-v1-user-login-resend-OTP" onclick="cancelTryOut('POSTapi-v1-user-login-resend-OTP');" hidden>Cancel</button>&nbsp;&nbsp;
    <button type="submit" style="background-color: #6ac174; padding: 5px 10px; border-radius: 5px; border-width: thin;" id="btn-executetryout-POSTapi-v1-user-login-resend-OTP" hidden>Send Request 💥</button>
    </h3>
<p>
<small class="badge badge-black">POST</small>
 <b><code>api/v1/user/login/resend-OTP</code></b>
</p>
<p>
<label id="auth-POSTapi-v1-user-login-resend-OTP" hidden>Authorization header: <b><code>Bearer </code></b><input type="text" name="Authorization" data-prefix="Bearer " data-endpoint="POSTapi-v1-user-login-resend-OTP" data-component="header"></label>
</p>
</form>



