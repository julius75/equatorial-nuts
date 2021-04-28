# Orders


## List Buyer Orders (Unrefined)

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/orders" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost/api/v1/orders"
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


## Store a newly created resource in storage.

<small class="badge badge-darkred">requires authentication</small>



> Example request:

```bash
curl -X POST \
    "http://localhost/api/v1/orders-create-new" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"farmer_id":12,"price_list_id":10,"buying_center_id":9,"raw_material_id":13,"bag_type_id":14,"bags":4,"gross_weight":"quam","net_weight":"voluptas","amount":"numquam","latitude":"quae","longitude":"perspiciatis"}'

```

```javascript
const url = new URL(
    "http://localhost/api/v1/orders-create-new"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "farmer_id": 12,
    "price_list_id": 10,
    "buying_center_id": 9,
    "raw_material_id": 13,
    "bag_type_id": 14,
    "bags": 4,
    "gross_weight": "quam",
    "net_weight": "voluptas",
    "amount": "numquam",
    "latitude": "quae",
    "longitude": "perspiciatis"
}

fetch(url, {
    method: "POST",
    headers,
    body: JSON.stringify(body),
}).then(response => response.json());
```


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



