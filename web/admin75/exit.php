<? 
session_start(); 
session_unset(permiso);
session_unset(id_admin);
session_unset(nivel_admin);
session_destroy();

header("location: index.php");
?> 
