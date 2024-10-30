<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle Inscription d'Utilisateur</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f4f4f4; margin: 0; padding: 0;">
    <table width="100%" bgcolor="#f4f4f4" cellpadding="0" cellspacing="0">
        <tr>
            <td>
                <table align="center" width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; margin: 40px auto; border-radius: 8px; overflow: hidden; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);">
                    <!-- Header -->
                    <tr>
                        <td bgcolor="#E85300" style="padding: 20px; text-align: center;">
                            <h1 style="color: #ffffff; font-size: 24px; margin: 0;">Nouvelle Inscription</h1>
                        </td>
                    </tr>
                    
                    <!-- Body -->
                    <tr>
                        <td style="padding: 20px; color: #333333;">
                            <p style="font-size: 18px; margin: 0;">Bonjour,</p>
                            <p style="font-size: 16px; line-height: 1.5; margin-top: 10px;">
                                Un nouvel utilisateur s'est inscrit sur votre Dashboard Khalishop.
                            </p>
                            <hr style="border: none; border-top: 1px solid #e0e0e0; margin: 20px 0;">
                            
                            <p style="font-size: 16px; margin: 0;"><strong>Nom :</strong> {{ $name }}</p>
                            <p style="font-size: 16px; margin: 5px 0;"><strong>Email :</strong> {{ $email }}</p>
                            <p style="font-size: 16px; margin: 5px 0;"><strong>Token d'authentification :</strong> {{ $auth_token }}</p>

                            <p style="font-size: 16px; line-height: 1.5; margin-top: 20px;">
                                Veuillez transmettre ce token à l'utilisateur de manière sécurisée pour qu'il puisse finaliser sa connexion.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td bgcolor="#f4f4f4" style="padding: 20px; text-align: center; color: #777777; font-size: 14px;">
                            <p style="margin: 0;">© Khalishop 2024. Tous droits réservés.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
