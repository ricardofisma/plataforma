

<script type="text/javascript" src="jsxgraphcore.js"></script>

$$ \frac{1}{(2\sigma)^\frac{\nu}{2}\Gamma\left(\frac{\nu}{2}\right)}x^{\frac{\nu}{2}-1}\exp\left\{-\frac{x}{2\sigma}\right\}=\prod_1^3$$
$$ \frac{1}{(2\sigma)^\frac{\nu}{2}\Gamma\left(\frac{\nu}{2}\right)}x^{\frac{\nu}{2}-1}\exp\left\{-\frac{x}{2\sigma}\right\}=\prod_1^3$$
$$ \frac{1}{(2\sigma)^\frac{\nu}{2}\Gamma\left(\frac{\nu}{2}\right)}x^{\frac{\nu}{2}-1}\exp\left\{-\frac{x}{2\sigma}\right\}=\prod_1^3$$
$$ \frac{1}{(2\sigma)^\frac{\nu}{2}\Gamma\left(\frac{\nu}{2}\right)}x^{\frac{\nu}{2}-1}\exp\left\{-\frac{x}{2\sigma}\right\}=\prod_1^3$$
$$ \frac{1}{(2\sigma)^\frac{\nu}{2}\Gamma\left(\frac{\nu}{2}\right)}x^{\frac{\nu}{2}-1}\exp\left\{-\frac{x}{2\sigma}\right\}=\prod_1^3$$





<h2>Distribucion lambda (Estandarización)</h2>

$$\left(2\pi\sigma^2\right)^{-\frac{1}{2}}\exp\left\{-\frac{1}{2\sigma^2}\left(x-\mu\right)^2\right\}$$

	<div id="new2" class="jxgbox" style="width:95%; height:450px;margin: auto;"></div>

	<script>
		JXG.Options.text.useMathJax = true;
		board = JXG.JSXGraph.initBoard("new2", { showNavigation: false, showCopyright: false, boundingbox: [-6.5, 1, 18, -0.5], axis: true, zoom:{wheel: true, enabled: false }, pan:{ needTwoFingers: false,enabled:false} });
		var segArr = [], ptArr = [], bellArr = [];
	
		var t1 = board.create('slider', [[4, 0.5], [15, 0.5], [0, 4, 20]], { name: '\\(r\\)', strokeColor: '#125', fillColor: 'white',size: 3, withTicks: false });
		var w1 = board.create('slider', [[4, 0.6], [15, 0.6], [0.1, 2, 10]], {name: '\\(\\lambda\\)', strokeColor: 'black', fillColor: 'white',size: 3 , withTicks: false});
		var f1 = function(x){ return Math.pow(x, t1.Value()-1) * Math.exp(-x);};
    
		var f1c = board.create("functiongraph", [f1, -20, 20], {strokeWidth: 2, highlight: false,strokeColor: '#306754'});
    
	var gamma=board.create("integral", [[0,100],f1c], {color:"rgb(0,0,200)",fillOpacity: 0.5,withLabel: false});

	var f2 = function (x){return w1.Value()/Math.pow(Math.PI,0.5) * Math.pow(w1.Value()*x, 0.5) * Math.exp(-w1.Value()*x);};
	var f2c = board.create("functiongraph", [f2, -20, 20], {strokeWidth: 2, highlight: false,strokeColor: '#3067'});

	var gamma=board.create("integral", [[0.5,10],f2c], {color:"rgb(0,0,200)",fillOpacity: 0.5,withLabel: false});


        board.create('text',[1,-0.2, function(){ return '\\(\\displaystyle\\int_{z_1}^{z_2}\\frac{1}{\\sqrt{2\\pi\\sigma^2}}e^{-\\frac{1}{2\\sigma^2}\\left(x-\\mu\\right)^2}= \\int_{x_1}^{x_2}\\frac{1}{\\sqrt{2\\pi}}e^{-\\frac{1}{2}\\left(x\\right)^2} = ' + gamma.Value().toFixed(3) +  '\\)'}], {highlight: false});

	</script>






$$ \frac{1}{(2\sigma)^\frac{\nu}{2}\Gamma\left(\frac{\nu}{2}\right)}x^{\frac{\nu}{2}-1}\exp\left\{-\frac{x}{2\sigma}\right\}$$







