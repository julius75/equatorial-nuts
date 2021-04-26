# Bag Types

API for fetching Bag Types

## List Bag Types




> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/bag-types" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/bag-types"
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
</form>



