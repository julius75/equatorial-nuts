# Raw Materials

API for Raw Material Products

## List all Raw Materials

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/raw-materials" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/raw-materials"
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


## Fetch Raw Materials Current Price

<small class="badge badge-darkred">requires authentication</small>

Returns Prices of all raw materials within the buyers specified region

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/raw-materials-prices" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/raw-materials-prices"
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


## Fetch Raw Materials Specifications

<small class="badge badge-darkred">requires authentication</small>

Returns Specifications of the desired Raw Material

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/raw-materials-requirements" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"raw_material_id":15}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/raw-materials-requirements"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "raw_material_id": 15
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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



