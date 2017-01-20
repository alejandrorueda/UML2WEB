
(function(document) {
  			  "use strict";
  			
  			  var __configureProperties = Polymer.Base._configureProperties;
  			
  			  Polymer.Base._addFeature({
  			      _configureProperties: function(properties, config) {
  			
  			          if (properties) {
  			            // Add global properties here
  			              properties.urlApi = {
  			                type: String,
  			                value: "/service/script.php"
  			              };
  			            }
  			
  			          __configureProperties.apply(this, [properties, config]);
  			      }
  			  });
  			
  		})(document);



