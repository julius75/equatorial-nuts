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
    -d '{"raw_material_id":7}'

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
    "raw_material_id": 7
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


## Submit Raw Material Requirement Submission

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/raw-materials-requirement-submission/create" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"order_id":17,"submissions":[]}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/raw-materials-requirement-submission/create"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "order_id": 17,
    "submissions": []
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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


## View an Order Details + Raw Material Requirement Submissions

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/raw-materials-requirement-submission/view" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"order_id":11}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/raw-materials-requirement-submission/view"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "order_id": 11
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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

</form>



