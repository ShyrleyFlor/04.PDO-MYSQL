<?php
#cerramos la sesion
session_destroy();

echo "<script>window.location = 'index.php?pagina=login';</script>";