# Password Management

APIs for user reset password

## Send Password Reset Token


Send password reset token via Email to the user with provided email address.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/password/forgot" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"quibusdam"}'

```

```javascript
const url = new URL(
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
}).then(response => response.json());
```


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


## Update Password


Update user's password after token verification.

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/user/password/update" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"email":"molestias","token":"dicta","password":"corporis","password_confirm":"iure"}'

```

```javascript
const url = new URL(
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
}).then(response => response.json());
```


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

</form>



