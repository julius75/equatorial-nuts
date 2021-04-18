# Farmers


## Display a listing of the resource.

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/farmers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/farmers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```
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


## Store a newly created resource in storage.

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/farmers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"full_name":"doloremque","phone_number":"aut","id_number":"et","gender":"voluptas","date_of_birth":"ut","region_id":1,"raw_material_ids":[]}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/farmers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "full_name": "doloremque",
    "phone_number": "aut",
    "id_number": "et",
    "gender": "voluptas",
    "date_of_birth": "ut",
    "region_id": 1,
    "raw_material_ids": []
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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


## Display the specified resource.

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X GET \
    -G "http://localhost/api/v1/farmers/13" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/farmers/13"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};


fetch(url, {
    method: "GET",
    headers,
}).then(response => response.json());
```


> Example response (401):

```json
{
    "message": "Unauthenticated."
}
```
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


## Search For a Farmer

<small class="badge badge-darkred">requires authentication</small>

Query can be: Phone Number, Full Name or Id Number

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/farmers-search" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"search_query":"est"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/farmers-search"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "search_query": "est"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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


## Filter Farmers by region

<small class="badge badge-darkred">requires authentication</small>

Gets Farmers within a specified region

> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/farmers-region-filter" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"region_id":6}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/farmers-region-filter"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "region_id": 6
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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



