<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Request a Membership</h2>
		<div>
			User with following details, has requested for photographer membership 
		</div>
		<table width="100%">
		    <tbody>
		        <tr>
		            <td width="20%">First Name: </td>
		            <td>{{ $first_name }}</td>
		        </tr>
		        <tr>
		            <td>Last Name: </td>
		            <td>{{ $last_name }}</td>
		        </tr>
		        <tr>
		            <td>Country: </td>
		            <td>{{ $country }}</td>
		        </tr>
		        <tr>
		            <td>State: </td>
		            <td>{{ $state }}</td>
		        </tr>
		        <tr>
		            <td>City/Town: </td>
		            <td>{{ $city }}</td>
		        </tr>
		        <tr>
		            <td>Email Address: </td>
		            <td>{{ $email }}</td>
		        </tr>
		        <tr>
		            <td>Are your photos in PNG or JPG format?: </td>
		            <td>{{ $photo_type }}</td>
		        </tr>
		        <tr>
		            <td colspan="2">
		                Are your photos large enough so that they have either a MINIMUM LENGTH of 3000 pixels OR a MINIMUM WIDTH of 2550 pixels?:
						{{ $photo_size }}
		            </td>
		        </tr>
		        <tr>
		            <td colspan="2">
		                IS THERE ONE OR MORE PAGES ON THE INTERNET WHERE I CAN SEE YOUR PHOTOS? (Please list all.):
						{{ $urls }}
		            </td>
		        </tr>

		        <tr>
		            <td>DO YOU HAVE A PAYPAL ACCOUNT?: </td>
		            <td>{{ $paypal }}</td>
		        </tr>
		        <tr>
		            <td>If No, would you be willing to get one (they're free)?: </td>
		            <td>{{ $get_paypal }}</td>
		        </tr>
		        <tr>
		            <td>Comments/Questions: </td>
		            <td>{{ $comments }}</td>
		        </tr>
		        {{ $images }}
				
		    </tbody>
		</table>
	</body>
</html>
