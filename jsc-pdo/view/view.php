<?php 
/**
* Ini class untuk tampilan depan
*/
class View{
	public function brand($brand){
		echo $brand;
	}
	public function title($title){
		echo "<title>".$title."</title>";
	}
	public function css(){
		$css = array(
			'<link href="assets/dist/css/bootstrap.min.css" rel="stylesheet"/>',
			'<link href="assets/dist/css/bootstrap-theme.min.css" rel="stylesheet"/>',
			'<link href="assets/dist/css/ie10-viewport-bug-workaround.css" rel="stylesheet"/>',
			'<link href="assets/dist/css/theme.css" rel="stylesheet"/>',
			'<link href="assets/highlight/styles/idea.css" rel="stylesheet"/>',
			);
		return implode(' ', $css);
	}
	public function javascript(){
		$js = array(
			'<script src="assets/highlight/highlight.pack.js"></script>',
			'<script src="assets/dist/js/ie-emulation-modes-warning.js"></script>',
			'<script src="assets/dist/js/jquery-1.9.1.js"></script>',
			'<script src="assets/dist/js/bootstrap.min.js"></script>',
			'<script src="assets/dist/js/ie10-viewport-bug-workaround.js"></script>',
			'<script>hljs.initHighlightingOnLoad();</script>',
			
			);
		return implode(' ', $js);
	}
}


 ?>