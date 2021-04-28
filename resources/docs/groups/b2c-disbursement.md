# B2C Disbursement

API for Disbursing funds to a registered farmer

## Initiate a Disbursement Request

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/initiate-mpesa-disbursement" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"order_id":"at"}'

```

```javascript
const url = new URL(
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
}).then(response => response.json());
```


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

</form>



