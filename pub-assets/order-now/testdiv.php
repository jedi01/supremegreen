<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<style type="text/css">
#div{   /*div central*/
    background: #00A8D9;
    width: 300px;
    height: 300px;
    margin: 50px auto;
    -moz-border-radius: 50%;
    -webkit-border-radius: 50%;
    border-radius: 50%;
    border:3px solid #000;
}



/* Page styling */




	</style>
	<title></title>
</head>
<body>


     
    <div  id="div"></div>
     <div  id="div"></div>
      <div  id="div"></div>

<script type="text/javascript">
  $('#div').resize(function(height) {
    var fuente = $(this).height() / 2;
    var margen = (fuente / 2) - 5;
    $('.contenido').css('font-size', fuente + 'px');
    $('.contenido').css('margin-top', margen + 'px');
});
</script>

<link rel="stylesheet" type="text/css" href="https://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" />

</body>
</html>