<h2>Hola. Soy la vista index, cargada desde el controlador Home, en el método index</h2>
<?php echo saludo();?>
<hr />
la fecha de hoy es : <?php echo fecha("2016-09-20");?>
<hr />
Tu edad es  : <?php echo calculaEdad("1980-05-24");?>
<hr />
<?php 
if(detectar_SO()==false)
{
    echo "es un PC";
}else
{
    echo "es un movil";
}
?>
