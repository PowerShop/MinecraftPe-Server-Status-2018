<?php
	use xPaw\MinecraftQuery;
   use xPaw\MinecraftQuery2;
	use xPaw\MinecraftQueryException;

	// Edit this ->
	define( 'MQ_SERVER_ADDR', '43.229.132.165' );
	define( 'MQ_SERVER_PORT', '19132' );
	define( 'MQ_TIMEOUT', 1 );
	// Edit this <-

	// Display everything in browser, because some people can't look in logs for errors
	Error_Reporting( E_ALL | E_STRICT );
	Ini_Set( 'display_errors', true );
   
   require __DIR__ . '/manager/Query.php';
	require __DIR__ . '/manager/MinecraftQuery.php';
	require __DIR__ . '/manager/MinecraftQueryException.php';

	$Timer = MicroTime( true );
   
   $Query= new MinecraftQuery( );
	$Query2 = new MinecraftQuery2( );

	try
	{
		$Query->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT );
	}
	catch( MinecraftQueryException $e )
	{
		$Exception = $e;
	}

try
	{
		$Query2->Connect( MQ_SERVER_ADDR, MQ_SERVER_PORT, MQ_TIMEOUT );
	}
	catch( MinecraftQueryException $e )
	{
		$Exception = $e;
	}
	$Timer = Number_Format( MicroTime( true ) - $Timer, 4, '.', '' );
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	

	<style type="text/css">
		.jumbotron {
			margin-top: 30px;
			border-radius: 0;
		}

		.table thead th {
			background-color: #428BCA;
			border-color: #428BCA !important;
			color: #FFF;
		}
	</style>
</head>

<body>
    <div class="container">
    	

<?php if( isset( $Exception ) ): ?>
		<div class="panel panel-primary">
			<div class="panel-heading"><?php echo htmlspecialchars( $Exception->getMessage( ) ); ?></div>
			<div class="panel-body"><?php echo nl2br( $e->getTraceAsString(), false ); ?></div>
		</div>
<?php else: ?>
		<center>
			<div class="col-sm-12">
				<table class="table table-bordered table-striped">
					<thead>
						<tr>
							<th>จำนวนผู้เล่นออนไลน์</th>
						</tr>
					</thead>
					<tbody>
<?php if( ( $Players = $Query->GetInfo( ) ) !== false ): ?>
<?php foreach( $Players as $Player ): ?>
						<tr>
<th>
						 ผู้เล่นที่กำลังออนไลน์ <?php echo htmlspecialchars( $Player ); ?> คน
</th>
						</tr>
<?php endforeach; ?>
<?php else: ?>
						<tr>
							<td>ไม่มีผู้เล่นออนไลน์ในขณะนี้</td>
						</tr>
<?php endif; ?>
					</tbody>

<tbody>
<?php if( ( $Players = $Query2->GetInfoo( ) ) !== false ): ?>
<?php foreach( $Players as $Player ): ?>
						<tr>
<th>
						จำนวนผู้เล่นที่รองรับ <?php echo htmlspecialchars( $Player ); ?> คน
</th>
						</tr>
<?php endforeach; ?>
<?php else: ?>
<p>
						<tr>
							<td>ไม่มีผู้เล่นออนไลน์ในขณะนี้</td>
						</tr>
<?php endif; ?>
					</tbody>
<thead>
						<tr>
							<th>ผู้เล่นที่กำลังออนไลน์ในขณะนี้</th>
						</tr>
					</thead>
					<tbody>
<?php if( ( $Players = $Query->GetPlayers( ) ) !== false ): ?>
<?php foreach( $Players as $Player ): ?>
						<tr>
<th>
						  <?php echo htmlspecialchars( $Player ); ?> 
</th>
						</tr>
<?php endforeach; ?>
<?php else: ?>
						<tr>
							<td>ไม่มีผู้เล่นออนไลน์ในขณะนี้</td>
						</tr>
<?php endif; ?>
					</tbody>
				</table>
			</div>
		</div>
<?php endif; ?>
	</div>

<center>

					
</table>
</div>
</center>

	</div>
</body>
</html>
