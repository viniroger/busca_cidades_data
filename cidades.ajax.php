header( 'Cache-Control: no-cache' );
header( 'Content-type: application/xml; charset="utf-8"', true );

include("arquivos/DBconn.php");
$dbname="NOME_DATABASE";
$link = connectToDB($dbname) or die('Não foi possível conectar ao banco de dados.');

$sigla = mysql_real_escape_string( $_REQUEST['sigla'] );
$cidades = array();
$sql = "SELECT cod_cidades, nome
		FROM cidades
		WHERE sigla='".$sigla."'
		ORDER BY nome COLLATE utf8_general_ci;";
$res = mysql_query($sql);
while ( $row = mysql_fetch_assoc( $res ) ) {
	$cidades[] = array(
		'cod_cidades'	=> $row['cod_cidades'],
		'nome'			=> $row['nome'],
	);
}

echo( json_encode( $cidades ) );

