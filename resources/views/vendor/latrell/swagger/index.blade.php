<!DOCTYPE html>
<html>
<head>
  <title>{{ config('latrell-swagger.title') }}</title>
  <link rel="icon" type="image/png" href="{{ asset('vendor/latrell/swagger/images/favicon-32x32.png') }}" sizes="32x32" />
  <link rel="icon" type="image/png" href="{{ asset('vendor/latrell/swagger/images/favicon-16x16.png') }}" sizes="16x16" />
  <link href='{{ asset('vendor/latrell/swagger/css/typography.css') }}' media='screen' rel='stylesheet' type='text/css'/>
  <link href='{{ asset('vendor/latrell/swagger/css/reset.css') }}' media='screen' rel='stylesheet' type='text/css'/>
  <link href='{{ asset('vendor/latrell/swagger/css/screen.css') }}' media='screen' rel='stylesheet' type='text/css'/>
  <link href='{{ asset('vendor/latrell/swagger/css/reset.css') }}' media='print' rel='stylesheet' type='text/css'/>
  <link href='{{ asset('vendor/latrell/swagger/css/print.css') }}' media='print' rel='stylesheet' type='text/css'/>
  <script src='{{ asset('vendor/latrell/swagger/lib/jquery-1.8.0.min.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/lib/jquery.slideto.min.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/lib/jquery.wiggle.min.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/lib/jquery.ba-bbq.min.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/lib/handlebars-2.0.0.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/lib/underscore-min.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/lib/backbone-min.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/swagger-ui.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/lib/highlight.7.3.pack.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/lib/marked.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/lib/swagger-oauth.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/lang/translator.js') }}' type='text/javascript'></script>
  <script src='{{ asset('vendor/latrell/swagger/lang/en.js') }}' type='text/javascript'></script>

  <script type="text/javascript">
    $(function () {
      window.swaggerUi = new SwaggerUi({
        url: "{{ URL::route('swagger_docs') }}",
        dom_id: "swagger-ui-container",
        supportedSubmitMethods: ['get', 'post', 'put', 'delete', 'patch'],
        onComplete: function(swaggerApi, swaggerUi){
          if(typeof initOAuth == "function") {
            initOAuth({
              clientId: "your-client-id",
              realm: "your-realms",
              appName: "your-app-name"
            });
          }

          $('pre code').each(function(i, e) {
            hljs.highlightBlock(e)
          });

          addApiKeyAuthorization();
        },
        onFailure: function(data) {
          log("Unable to Load SwaggerUI");
        },
        docExpansion: "none",
        apisSorter: "alpha"
      });

      function addApiKeyAuthorization(){
      function addApiKeyAuthorization(){
        var key = $('#input_apiKey')[0].value;
        if(key && key.trim() != "") {
          swaggerUi.api.clientAuthorizations.add("key", new SwaggerClient.ApiKeyAuthorization("X-Authorization", key, "header"));
        }
      }

      }

      $('#input_apiKey').change(addApiKeyAuthorization);

      // if you have an apiKey you would like to pre-populate on the page for demonstration purposes...
      /*
        var apiKey = "myApiKeyXXXX123456789";
        $('#input_apiKey').val(apiKey);
      */

      window.swaggerUi.load();

      function log() {
        if ('console' in window) {
          console.log.apply(console, arguments);
        }
      }
  });
  </script>
</head>

<body class="swagger-section">
<div id='header'>
  <div class="swagger-ui-wrap">
    <a id="logo" href="http://swagger.io">swagger</a>
    <form id='api_selector'>
      <div class='input'><input placeholder="http://example.com/api" id="input_baseUrl" name="baseUrl" type="text"/></div>
      <div class='input'><input placeholder="api_key" id="input_apiKey" name="apiKey" type="text"/></div>
      <div class='input'><a id="explore" href="#">Explore</a></div>
    </form>
  </div>
</div>

<div id="message-bar" class="swagger-ui-wrap">&nbsp;</div>
<div id="swagger-ui-container" class="swagger-ui-wrap"></div>
</body>
</html>