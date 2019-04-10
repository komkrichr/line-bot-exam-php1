							
              $name='10.1102312,123012312.123123';
              $url = 'http://43.254.133.192/raid/add_location.asp';
							$ch = curl_init( $url );
							$myvars = 'txtlocation_desc='.$name;
							$headers = ['Content-Type' => 'application/x-www-form-urlencoded', 'charset' => 'windows-874'];
							curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false);
							curl_setopt( $ch, CURLOPT_HEADER, $headers);
							curl_setopt( $ch, CURLOPT_ENCODING, 'windows-874');
							curl_setopt( $ch, CURLOPT_POST, 1);
							curl_setopt( $ch, CURLOPT_POSTFIELDS, $myvars);
							curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);				
							curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
							$response = curl_exec( $ch );
