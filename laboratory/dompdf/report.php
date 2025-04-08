<!doctype html>
<html>
 <head>
  <script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
 </head>
 <body>
  <h1>Take screenshot of webpage with html2canvas</h1>
  <div class="specific">
		<h1>Click to Take a Screenshot & Download it! <small>using html2canvas.js + canvas2image.js</small></h1> 
		<p>
		    This is a simple demo.
		</p>
  <p>
		   Use html2canvas.js to take a screenshot of a specific div and then use canvas2image.js to download the screenshot as an image locally to your filesystem.
		</p>
		<button type="button" class="btn btn-default">Take a Screenshot!</button>
  <p>References:  <a href="https://html2canvas.hertzen.com/">html2canvas.js</a><a href="https://github.com/SuperAL/canvas2image">canvas2image.js</a></p>
	</div>
  <!-- Script -->
  <script type='text/javascript'>
    // function screenshot() {
    //     html2canvas(document.body).then(function(canvas) {
    //         document.body.appendChild(canvas);
    //     });
    // }
    //
    document.querySelector('button').addEventListener('click', function() {
        html2canvas(document.querySelector('.specific'), {
            onrendered: function(canvas) {
                document.body.appendChild(canvas);
            //   return Canvas2Image.saveAsPNG(canvas);
            }
        });
    });
  </script>

 </body>
</html>