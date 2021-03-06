<?php

use Illuminate\Database\Seeder;

class CountriesTableSeeder extends Seeder
{
    /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $countries = [
            ['code' => 'AF', 'codigo' => '093', 'name_es' => 'Afganistán', 'name_en' => 'Afghanistan'],
            ['code' => 'AL', 'codigo' => '355', 'name_es' => 'Albania', 'name_en' => 'Albania'],
            ['code' => 'DE', 'codigo' => '049', 'name_es' => 'Alemania', 'name_en' => 'Germany'],
            ['code' => 'DZ', 'codigo' => '213', 'name_es' => 'Algeria', 'name_en' => 'Algeria'],
            ['code' => 'AD', 'codigo' => '376', 'name_es' => 'Andorra', 'name_en' => 'Andorra'],
            ['code' => 'AO', 'codigo' => '244', 'name_es' => 'Angola', 'name_en' => 'Angola'],
            ['code' => 'AI', 'codigo' => '264', 'name_es' => 'Anguila', 'name_en' => 'Anguilla'],
            ['code' => 'AQ', 'codigo' => '672', 'name_es' => 'Antártida', 'name_en' => 'Antarctica'],
            ['code' => 'AG', 'codigo' => '268', 'name_es' => 'Antigua y Barbuda', 'name_en' => 'Antigua and Barbuda'],
            ['code' => 'AN', 'codigo' => '599', 'name_es' => 'Antillas Neerlandesas', 'name_en' => 'Netherlands Antilles'],
            ['code' => 'SA', 'codigo' => '966', 'name_es' => 'Arabia Saudita', 'name_en' => 'Saudi Arabia'],
            ['code' => 'AR', 'codigo' => '054', 'name_es' => 'Argentina', 'name_en' => 'Argentina'],
            ['code' => 'AM', 'codigo' => '374', 'name_es' => 'Armenia', 'name_en' => 'Armenia'],
            ['code' => 'AW', 'codigo' => '297', 'name_es' => 'Aruba', 'name_en' => 'Aruba'],
            ['code' => 'AU', 'codigo' => '061', 'name_es' => 'Australia', 'name_en' => 'Australia'],
            ['code' => 'AT', 'codigo' => '043', 'name_es' => 'Austria', 'name_en' => 'Austria'],
            ['code' => 'AZ', 'codigo' => '994', 'name_es' => 'Azerbayán', 'name_en' => 'Azerbaijan'],
            ['code' => 'BE', 'codigo' => '032', 'name_es' => 'Bélgica', 'name_en' => 'Belgium'],
            ['code' => 'BS', 'codigo' => '242', 'name_es' => 'Bahamas', 'name_en' => 'Bahamas'],
            ['code' => 'BH', 'codigo' => '973', 'name_es' => 'Bahrein', 'name_en' => 'Bahrain'],
            ['code' => 'BD', 'codigo' => '880', 'name_es' => 'Bangladesh', 'name_en' => 'Bangladesh'],
            ['code' => 'BB', 'codigo' => '246', 'name_es' => 'Barbados', 'name_en' => 'Barbados'],
            ['code' => 'BZ', 'codigo' => '501', 'name_es' => 'Belice', 'name_en' => 'Belize'],
            ['code' => 'BJ', 'codigo' => '229', 'name_es' => 'Benín', 'name_en' => 'Benin'],
            ['code' => 'BT', 'codigo' => '975', 'name_es' => 'Bhután', 'name_en' => 'Bhutan'],
            ['code' => 'BY', 'codigo' => '375', 'name_es' => 'Bielorrusia', 'name_en' => 'Belarus'],
            ['code' => 'MM', 'codigo' => '095', 'name_es' => 'Birmania', 'name_en' => 'Myanmar'],
            ['code' => 'BO', 'codigo' => '591', 'name_es' => 'Bolivia', 'name_en' => 'Bolivia'],
            ['code' => 'BA', 'codigo' => '387', 'name_es' => 'Bosnia y Herzegovina', 'name_en' => 'Bosnia and Herzegovina'],
            ['code' => 'BW', 'codigo' => '267', 'name_es' => 'Botsuana', 'name_en' => 'Botswana'],
            ['code' => 'BR', 'codigo' => '055', 'name_es' => 'Brasil', 'name_en' => 'Brazil'],
            ['code' => 'BN', 'codigo' => '673', 'name_es' => 'Brunéi', 'name_en' => 'Brunei'],
            ['code' => 'BG', 'codigo' => '359', 'name_es' => 'Bulgaria', 'name_en' => 'Bulgaria'],
            ['code' => 'BF', 'codigo' => '226', 'name_es' => 'Burkina Faso', 'name_en' => 'Burkina Faso'],
            ['code' => 'BI', 'codigo' => '257', 'name_es' => 'Burundi', 'name_en' => 'Burundi'],
            ['code' => 'CV', 'codigo' => '238', 'name_es' => 'Cabo Verde', 'name_en' => 'Cape Verde'],
            ['code' => 'KH', 'codigo' => '855', 'name_es' => 'Camboya', 'name_en' => 'Cambodia'],
            ['code' => 'CM', 'codigo' => '237', 'name_es' => 'Camerún', 'name_en' => 'Cameroon'],
            ['code' => 'CA', 'codigo' => '011', 'name_es' => 'Canadá', 'name_en' => 'Canada'],
            ['code' => 'TD', 'codigo' => '235', 'name_es' => 'Chad', 'name_en' => 'Chad'],
            ['code' => 'CL', 'codigo' => '056', 'name_es' => 'Chile', 'name_en' => 'Chile'],
            ['code' => 'CN', 'codigo' => '086', 'name_es' => 'China', 'name_en' => 'China'],
            ['code' => 'CY', 'codigo' => '357', 'name_es' => 'Chipre', 'name_en' => 'Cyprus'],
            ['code' => 'VA', 'codigo' => '039', 'name_es' => 'Ciudad del Vaticano', 'name_en' => 'Vatican City State'],
            ['code' => 'CO', 'codigo' => '057', 'name_es' => 'Colombia', 'name_en' => 'Colombia'],
            ['code' => 'KM', 'codigo' => '269', 'name_es' => 'Comoras', 'name_en' => 'Comoros'],
            ['code' => 'CG', 'codigo' => '242', 'name_es' => 'Congo', 'name_en' => 'Congo'],
            ['code' => 'CD', 'codigo' => '243', 'name_es' => 'Congo', 'name_en' => 'Congo'],
            ['code' => 'KP', 'codigo' => '850', 'name_es' => 'Corea del Norte', 'name_en' => 'North Korea'],
            ['code' => 'KR', 'codigo' => '082', 'name_es' => 'Corea del Sur', 'name_en' => 'South Korea'],
            ['code' => 'CI', 'codigo' => '225', 'name_es' => 'Costa de Marfil', 'name_en' => 'Ivory Coast'],
            ['code' => 'CR', 'codigo' => '506', 'name_es' => 'Costa Rica', 'name_en' => 'Costa Rica'],
            ['code' => 'HR', 'codigo' => '385', 'name_es' => 'Croacia', 'name_en' => 'Croatia'],
            ['code' => 'CU', 'codigo' => '053', 'name_es' => 'Cuba', 'name_en' => 'Cuba'],
            ['code' => 'DK', 'codigo' => '045', 'name_es' => 'Dinamarca', 'name_en' => 'Denmark'],
            ['code' => 'DM', 'codigo' => '767', 'name_es' => 'Dominica', 'name_en' => 'Dominica'],
            ['code' => 'EC', 'codigo' => '593', 'name_es' => 'Ecuador', 'name_en' => 'Ecuador'],
            ['code' => 'EG', 'codigo' => '020', 'name_es' => 'Egipto', 'name_en' => 'Egypt'],
            ['code' => 'SV', 'codigo' => '503', 'name_es' => 'El Salvador', 'name_en' => 'El Salvador'],
            ['code' => 'AE', 'codigo' => '971', 'name_es' => 'Emiratos Árabes Unidos', 'name_en' => 'United Arab Emirates'],
            ['code' => 'ER', 'codigo' => '291', 'name_es' => 'Eritrea', 'name_en' => 'Eritrea'],
            ['code' => 'SK', 'codigo' => '421', 'name_es' => 'Eslovaquia', 'name_en' => 'Slovakia'],
            ['code' => 'SI', 'codigo' => '386', 'name_es' => 'Eslovenia', 'name_en' => 'Slovenia'],
            ['code' => 'ES', 'codigo' => '034', 'name_es' => 'España', 'name_en' => 'Spain'],
            ['code' => 'US', 'codigo' => '001', 'name_es' => 'Estados Unidos de América', 'name_en' => 'United States of America'],
            ['code' => 'EE', 'codigo' => '372', 'name_es' => 'Estonia', 'name_en' => 'Estonia'],
            ['code' => 'ET', 'codigo' => '251', 'name_es' => 'Etiopía', 'name_en' => 'Ethiopia'],
            ['code' => 'PH', 'codigo' => '063', 'name_es' => 'Filipinas', 'name_en' => 'Philippines'],
            ['code' => 'FI', 'codigo' => '358', 'name_es' => 'Finlandia', 'name_en' => 'Finland'],
            ['code' => 'FJ', 'codigo' => '679', 'name_es' => 'Fiyi', 'name_en' => 'Fiji'],
            ['code' => 'FR', 'codigo' => '033', 'name_es' => 'Francia', 'name_en' => 'France'],
            ['code' => 'GA', 'codigo' => '241', 'name_es' => 'Gabón', 'name_en' => 'Gabon'],
            ['code' => 'GM', 'codigo' => '220', 'name_es' => 'Gambia', 'name_en' => 'Gambia'],
            ['code' => 'GE', 'codigo' => '995', 'name_es' => 'Georgia', 'name_en' => 'Georgia'],
            ['code' => 'GH', 'codigo' => '233', 'name_es' => 'Ghana', 'name_en' => 'Ghana'],
            ['code' => 'GI', 'codigo' => '350', 'name_es' => 'Gibraltar', 'name_en' => 'Gibraltar'],
            ['code' => 'GD', 'codigo' => '473', 'name_es' => 'Granada', 'name_en' => 'Grenada'],
            ['code' => 'GR', 'codigo' => '030', 'name_es' => 'Grecia', 'name_en' => 'Greece'],
            ['code' => 'GL', 'codigo' => '299', 'name_es' => 'Groenlandia', 'name_en' => 'Greenland'],
            ['code' => 'GP', 'codigo' => '999', 'name_es' => 'Guadalupe', 'name_en' => 'Guadeloupe'],
            ['code' => 'GU', 'codigo' => '671', 'name_es' => 'Guam', 'name_en' => 'Guam'],
            ['code' => 'GT', 'codigo' => '502', 'name_es' => 'Guatemala', 'name_en' => 'Guatemala'],
            ['code' => 'GF', 'codigo' => '999', 'name_es' => 'Guayana Francesa', 'name_en' => 'French Guiana'],
            ['code' => 'GG', 'codigo' => '999', 'name_es' => 'Guernsey', 'name_en' => 'Guernsey'],
            ['code' => 'GN', 'codigo' => '224', 'name_es' => 'Guinea', 'name_en' => 'Guinea'],
            ['code' => 'GQ', 'codigo' => '240', 'name_es' => 'Guinea Ecuatorial', 'name_en' => 'Equatorial Guinea'],
            ['code' => 'GW', 'codigo' => '245', 'name_es' => 'Guinea-Bissau', 'name_en' => 'Guinea-Bissau'],
            ['code' => 'GY', 'codigo' => '592', 'name_es' => 'Guyana', 'name_en' => 'Guyana'],
            ['code' => 'HT', 'codigo' => '509', 'name_es' => 'Haití', 'name_en' => 'Haiti'],
            ['code' => 'HN', 'codigo' => '504', 'name_es' => 'Honduras', 'name_en' => 'Honduras'],
            ['code' => 'HK', 'codigo' => '852', 'name_es' => 'Hong kong', 'name_en' => 'Hong Kong'],
            ['code' => 'HU', 'codigo' => '036', 'name_es' => 'Hungría', 'name_en' => 'Hungary'],
            ['code' => 'IN', 'codigo' => '091', 'name_es' => 'India', 'name_en' => 'India'],
            ['code' => 'ID', 'codigo' => '062', 'name_es' => 'Indonesia', 'name_en' => 'Indonesia'],
            ['code' => 'IR', 'codigo' => '098', 'name_es' => 'Irán', 'name_en' => 'Iran'],
            ['code' => 'IQ', 'codigo' => '964', 'name_es' => 'Irak', 'name_en' => 'Iraq'],
            ['code' => 'IE', 'codigo' => '353', 'name_es' => 'Irlanda', 'name_en' => 'Ireland'],
            ['code' => 'BV', 'codigo' => '999', 'name_es' => 'Isla Bouvet', 'name_en' => 'Bouvet Island'],
            ['code' => 'IM', 'codigo' => '044', 'name_es' => 'Isla de Man', 'name_en' => 'Isle of Man'],
            ['code' => 'CX', 'codigo' => '061', 'name_es' => 'Isla de Navidad', 'name_en' => 'Christmas Island'],
            ['code' => 'NF', 'codigo' => '999', 'name_es' => 'Isla Norfolk', 'name_en' => 'Norfolk Island'],
            ['code' => 'IS', 'codigo' => '354', 'name_es' => 'Islandia', 'name_en' => 'Iceland'],
            ['code' => 'BM', 'codigo' => '441', 'name_es' => 'Islas Bermudas', 'name_en' => 'Bermuda Islands'],
            ['code' => 'KY', 'codigo' => '345', 'name_es' => 'Islas Caimán', 'name_en' => 'Cayman Islands'],
            ['code' => 'CC', 'codigo' => '061', 'name_es' => 'Islas Cocos (Keeling)', 'name_en' => 'Cocos (Keeling) Islands'],
            ['code' => 'CK', 'codigo' => '682', 'name_es' => 'Islas Cook', 'name_en' => 'Cook Islands'],
            ['code' => 'AX', 'codigo' => '999', 'name_es' => 'Islas de Åland', 'name_en' => 'Åland Islands'],
            ['code' => 'FO', 'codigo' => '298', 'name_es' => 'Islas Feroe', 'name_en' => 'Faroe Islands'],
            ['code' => 'GS', 'codigo' => '999', 'name_es' => 'Islas Georgias del Sur y Sandwich del Sur', 'name_en' => 'South Georgia and the South Sandwich Islands'],
            ['code' => 'HM', 'codigo' => '999', 'name_es' => 'Islas Heard y McDonald', 'name_en' => 'Heard Island and McDonald Islands'],
            ['code' => 'MV', 'codigo' => '960', 'name_es' => 'Islas Maldivas', 'name_en' => 'Maldives'],
            ['code' => 'FK', 'codigo' => '500', 'name_es' => 'Islas Malvinas', 'name_en' => 'Falkland Islands (Malvinas)'],
            ['code' => 'MP', 'codigo' => '670', 'name_es' => 'Islas Marianas del Norte', 'name_en' => 'Northern Mariana Islands'],
            ['code' => 'MH', 'codigo' => '692', 'name_es' => 'Islas Marshall', 'name_en' => 'Marshall Islands'],
            ['code' => 'PN', 'codigo' => '870', 'name_es' => 'Islas Pitcairn', 'name_en' => 'Pitcairn Islands'],
            ['code' => 'SB', 'codigo' => '677', 'name_es' => 'Islas Salomón', 'name_en' => 'Solomon Islands'],
            ['code' => 'TC', 'codigo' => '649', 'name_es' => 'Islas Turcas y Caicos', 'name_en' => 'Turks and Caicos Islands'],
            ['code' => 'UM', 'codigo' => '999', 'name_es' => 'Islas Ultramarinas Menores de Estados Unidos', 'name_en' => 'United States Minor Outlying Islands'],
            ['code' => 'VG', 'codigo' => '284', 'name_es' => 'Islas Vírgenes Británicas', 'name_en' => 'Virgin Islands'],
            ['code' => 'VI', 'codigo' => '340', 'name_es' => 'Islas Vírgenes de los Estados Unidos', 'name_en' => 'United States Virgin Islands'],
            ['code' => 'IL', 'codigo' => '972', 'name_es' => 'Israel', 'name_en' => 'Israel'],
            ['code' => 'IT', 'codigo' => '039', 'name_es' => 'Italia', 'name_en' => 'Italy'],
            ['code' => 'JM', 'codigo' => '876', 'name_es' => 'Jamaica', 'name_en' => 'Jamaica'],
            ['code' => 'JP', 'codigo' => '081', 'name_es' => 'Japón', 'name_en' => 'Japan'],
            ['code' => 'JE', 'codigo' => '999', 'name_es' => 'Jersey', 'name_en' => 'Jersey'],
            ['code' => 'JO', 'codigo' => '962', 'name_es' => 'Jordania', 'name_en' => 'Jordan'],
            ['code' => 'KZ', 'codigo' => '077', 'name_es' => 'Kazajistán', 'name_en' => 'Kazakhstan'],
            ['code' => 'KE', 'codigo' => '254', 'name_es' => 'Kenia', 'name_en' => 'Kenya'],
            ['code' => 'KG', 'codigo' => '996', 'name_es' => 'Kirgizstán', 'name_en' => 'Kyrgyzstan'],
            ['code' => 'KI', 'codigo' => '686', 'name_es' => 'Kiribati', 'name_en' => 'Kiribati'],
            ['code' => 'KW', 'codigo' => '965', 'name_es' => 'Kuwait', 'name_en' => 'Kuwait'],
            ['code' => 'LB', 'codigo' => '961', 'name_es' => 'Líbano', 'name_en' => 'Lebanon'],
            ['code' => 'LA', 'codigo' => '856', 'name_es' => 'Laos', 'name_en' => 'Laos'],
            ['code' => 'LS', 'codigo' => '266', 'name_es' => 'Lesoto', 'name_en' => 'Lesotho'],
            ['code' => 'LV', 'codigo' => '371', 'name_es' => 'Letonia', 'name_en' => 'Latvia'],
            ['code' => 'LR', 'codigo' => '231', 'name_es' => 'Liberia', 'name_en' => 'Liberia'],
            ['code' => 'LY', 'codigo' => '218', 'name_es' => 'Libia', 'name_en' => 'Libya'],
            ['code' => 'LI', 'codigo' => '423', 'name_es' => 'Liechtenstein', 'name_en' => 'Liechtenstein'],
            ['code' => 'LT', 'codigo' => '370', 'name_es' => 'Lituania', 'name_en' => 'Lithuania'],
            ['code' => 'LU', 'codigo' => '352', 'name_es' => 'Luxemburgo', 'name_en' => 'Luxembourg'],
            ['code' => 'MX', 'codigo' => '052', 'name_es' => 'México', 'name_en' => 'Mexico'],
            ['code' => 'MC', 'codigo' => '377', 'name_es' => 'Mónaco', 'name_en' => 'Monaco'],
            ['code' => 'MO', 'codigo' => '853', 'name_es' => 'Macao', 'name_en' => 'Macao'],
            ['code' => 'MK', 'codigo' => '389', 'name_es' => 'Macedônia', 'name_en' => 'Macedonia'],
            ['code' => 'MG', 'codigo' => '261', 'name_es' => 'Madagascar', 'name_en' => 'Madagascar'],
            ['code' => 'MY', 'codigo' => '060', 'name_es' => 'Malasia', 'name_en' => 'Malaysia'],
            ['code' => 'MW', 'codigo' => '265', 'name_es' => 'Malawi', 'name_en' => 'Malawi'],
            ['code' => 'ML', 'codigo' => '223', 'name_es' => 'Mali', 'name_en' => 'Mali'],
            ['code' => 'MT', 'codigo' => '356', 'name_es' => 'Malta', 'name_en' => 'Malta'],
            ['code' => 'MA', 'codigo' => '212', 'name_es' => 'Marruecos', 'name_en' => 'Morocco'],
            ['code' => 'MQ', 'codigo' => '999', 'name_es' => 'Martinica', 'name_en' => 'Martinique'],
            ['code' => 'MU', 'codigo' => '230', 'name_es' => 'Mauricio', 'name_en' => 'Mauritius'],
            ['code' => 'MR', 'codigo' => '222', 'name_es' => 'Mauritania', 'name_en' => 'Mauritania'],
            ['code' => 'YT', 'codigo' => '262', 'name_es' => 'Mayotte', 'name_en' => 'Mayotte'],
            ['code' => 'FM', 'codigo' => '691', 'name_es' => 'Micronesia', 'name_en' => 'Estados Federados de'],
            ['code' => 'MD', 'codigo' => '373', 'name_es' => 'Moldavia', 'name_en' => 'Moldova'],
            ['code' => 'MN', 'codigo' => '976', 'name_es' => 'Mongolia', 'name_en' => 'Mongolia'],
            ['code' => 'ME', 'codigo' => '382', 'name_es' => 'Montenegro', 'name_en' => 'Montenegro'],
            ['code' => 'MS', 'codigo' => '664', 'name_es' => 'Montserrat', 'name_en' => 'Montserrat'],
            ['code' => 'MZ', 'codigo' => '258', 'name_es' => 'Mozambique', 'name_en' => 'Mozambique'],
            ['code' => 'NA', 'codigo' => '264', 'name_es' => 'Namibia', 'name_en' => 'Namibia'],
            ['code' => 'NR', 'codigo' => '674', 'name_es' => 'Nauru', 'name_en' => 'Nauru'],
            ['code' => 'NP', 'codigo' => '977', 'name_es' => 'Nepal', 'name_en' => 'Nepal'],
            ['code' => 'NI', 'codigo' => '505', 'name_es' => 'Nicaragua', 'name_en' => 'Nicaragua'],
            ['code' => 'NE', 'codigo' => '227', 'name_es' => 'Niger', 'name_en' => 'Niger'],
            ['code' => 'NG', 'codigo' => '234', 'name_es' => 'Nigeria', 'name_en' => 'Nigeria'],
            ['code' => 'NU', 'codigo' => '683', 'name_es' => 'Niue', 'name_en' => 'Niue'],
            ['code' => 'NO', 'codigo' => '047', 'name_es' => 'Noruega', 'name_en' => 'Norway'],
            ['code' => 'NC', 'codigo' => '687', 'name_es' => 'Nueva Caledonia', 'name_en' => 'New Caledonia'],
            ['code' => 'NZ', 'codigo' => '064', 'name_es' => 'Nueva Zelanda', 'name_en' => 'New Zealand'],
            ['code' => 'OM', 'codigo' => '968', 'name_es' => 'Omán', 'name_en' => 'Oman'],
            ['code' => 'NL', 'codigo' => '031', 'name_es' => 'Países Bajos', 'name_en' => 'Netherlands'],
            ['code' => 'PK', 'codigo' => '092', 'name_es' => 'Pakistán', 'name_en' => 'Pakistan'],
            ['code' => 'PW', 'codigo' => '680', 'name_es' => 'Palau', 'name_en' => 'Palau'],
            ['code' => 'PS', 'codigo' => '999', 'name_es' => 'Palestina', 'name_en' => 'Palestine'],
            ['code' => 'PA', 'codigo' => '507', 'name_es' => 'Panamá', 'name_en' => 'Panama'],
            ['code' => 'PG', 'codigo' => '675', 'name_es' => 'Papúa Nueva Guinea', 'name_en' => 'Papua New Guinea'],
            ['code' => 'PY', 'codigo' => '595', 'name_es' => 'Paraguay', 'name_en' => 'Paraguay'],
            ['code' => 'PE', 'codigo' => '051', 'name_es' => 'Perú', 'name_en' => 'Peru'],
            ['code' => 'PF', 'codigo' => '689', 'name_es' => 'Polinesia Francesa', 'name_en' => 'French Polynesia'],
            ['code' => 'PL', 'codigo' => '048', 'name_es' => 'Polonia', 'name_en' => 'Poland'],
            ['code' => 'PT', 'codigo' => '351', 'name_es' => 'Portugal', 'name_en' => 'Portugal'],
            ['code' => 'PR', 'codigo' => '111', 'name_es' => 'Puerto Rico', 'name_en' => 'Puerto Rico'],
            ['code' => 'QA', 'codigo' => '974', 'name_es' => 'Qatar', 'name_en' => 'Qatar'],
            ['code' => 'GB', 'codigo' => '044', 'name_es' => 'Reino Unido', 'name_en' => 'United Kingdom'],
            ['code' => 'CF', 'codigo' => '236', 'name_es' => 'República Centroafricana', 'name_en' => 'Central African Republic'],
            ['code' => 'CZ', 'codigo' => '420', 'name_es' => 'República Checa', 'name_en' => 'Czech Republic'],
            ['code' => 'DO', 'codigo' => '809', 'name_es' => 'República Dominicana', 'name_en' => 'Dominican Republic'],
            ['code' => 'RE', 'codigo' => '999', 'name_es' => 'Reunión', 'name_en' => 'Réunion'],
            ['code' => 'RW', 'codigo' => '250', 'name_es' => 'Ruanda', 'name_en' => 'Rwanda'],
            ['code' => 'RO', 'codigo' => '040', 'name_es' => 'Rumanía', 'name_en' => 'Romania'],
            ['code' => 'RU', 'codigo' => '007', 'name_es' => 'Rusia', 'name_en' => 'Russia'],
            ['code' => 'EH', 'codigo' => '999', 'name_es' => 'Sahara Occidental', 'name_en' => 'Western Sahara'],
            ['code' => 'WS', 'codigo' => '685', 'name_es' => 'Samoa', 'name_en' => 'Samoa'],
            ['code' => 'AS', 'codigo' => '684', 'name_es' => 'Samoa Americana', 'name_en' => 'American Samoa'],
            ['code' => 'BL', 'codigo' => '590', 'name_es' => 'San Bartolomé', 'name_en' => 'Saint Barthélemy'],
            ['code' => 'KN', 'codigo' => '869', 'name_es' => 'San Cristóbal y Nieves', 'name_en' => 'Saint Kitts and Nevis'],
            ['code' => 'SM', 'codigo' => '378', 'name_es' => 'San Marino', 'name_en' => 'San Marino'],
            ['code' => 'MF', 'codigo' => '599', 'name_es' => 'San Martín (Francia)', 'name_en' => 'Saint Martin (French part)'],
            ['code' => 'PM', 'codigo' => '508', 'name_es' => 'San Pedro y Miquelón', 'name_en' => 'Saint Pierre and Miquelon'],
            ['code' => 'VC', 'codigo' => '784', 'name_es' => 'San Vicente y las Granadinas', 'name_en' => 'Saint Vincent and the Grenadines'],
            ['code' => 'SH', 'codigo' => '290', 'name_es' => 'Santa Elena', 'name_en' => 'Ascensión y Tristán de Acuña'],
            ['code' => 'LC', 'codigo' => '758', 'name_es' => 'Santa Lucía', 'name_en' => 'Saint Lucia'],
            ['code' => 'ST', 'codigo' => '239', 'name_es' => 'Santo Tomé y Príncipe', 'name_en' => 'Sao Tome and Principe'],
            ['code' => 'SN', 'codigo' => '221', 'name_es' => 'Senegal', 'name_en' => 'Senegal'],
            ['code' => 'RS', 'codigo' => '381', 'name_es' => 'Serbia', 'name_en' => 'Serbia'],
            ['code' => 'SC', 'codigo' => '248', 'name_es' => 'Seychelles', 'name_en' => 'Seychelles'],
            ['code' => 'SL', 'codigo' => '232', 'name_es' => 'Sierra Leona', 'name_en' => 'Sierra Leone'],
            ['code' => 'SG', 'codigo' => '065', 'name_es' => 'Singapur', 'name_en' => 'Singapore'],
            ['code' => 'SY', 'codigo' => '963', 'name_es' => 'Siria', 'name_en' => 'Syria'],
            ['code' => 'SO', 'codigo' => '252', 'name_es' => 'Somalia', 'name_en' => 'Somalia'],
            ['code' => 'LK', 'codigo' => '094', 'name_es' => 'Sri lanka', 'name_en' => 'Sri Lanka'],
            ['code' => 'ZA', 'codigo' => '027', 'name_es' => 'Sudáfrica', 'name_en' => 'South Africa'],
            ['code' => 'SD', 'codigo' => '249', 'name_es' => 'Sudán', 'name_en' => 'Sudan'],
            ['code' => 'SE', 'codigo' => '046', 'name_es' => 'Suecia', 'name_en' => 'Sweden'],
            ['code' => 'CH', 'codigo' => '041', 'name_es' => 'Suiza', 'name_en' => 'Switzerland'],
            ['code' => 'SR', 'codigo' => '597', 'name_es' => 'Surinám', 'name_en' => 'Suriname'],
            ['code' => 'SJ', 'codigo' => '999', 'name_es' => 'Svalbard y Jan Mayen', 'name_en' => 'Svalbard and Jan Mayen'],
            ['code' => 'SZ', 'codigo' => '268', 'name_es' => 'Swazilandia', 'name_en' => 'Swaziland'],
            ['code' => 'TJ', 'codigo' => '992', 'name_es' => 'Tadjikistán', 'name_en' => 'Tajikistan'],
            ['code' => 'TH', 'codigo' => '066', 'name_es' => 'Tailandia', 'name_en' => 'Thailand'],
            ['code' => 'TW', 'codigo' => '886', 'name_es' => 'Taiwán', 'name_en' => 'Taiwan'],
            ['code' => 'TZ', 'codigo' => '255', 'name_es' => 'Tanzania', 'name_en' => 'Tanzania'],
            ['code' => 'IO', 'codigo' => '999', 'name_es' => 'Territorio Británico del Océano Índico', 'name_en' => 'British Indian Ocean Territory'],
            ['code' => 'TF', 'codigo' => '999', 'name_es' => 'Territorios Australes y Antárticas Franceses', 'name_en' => 'French Southern Territories'],
            ['code' => 'TL', 'codigo' => '670', 'name_es' => 'Timor Oriental', 'name_en' => 'East Timor'],
            ['code' => 'TG', 'codigo' => '228', 'name_es' => 'Togo', 'name_en' => 'Togo'],
            ['code' => 'TK', 'codigo' => '690', 'name_es' => 'Tokelau', 'name_en' => 'Tokelau'],
            ['code' => 'TO', 'codigo' => '676', 'name_es' => 'Tonga', 'name_en' => 'Tonga'],
            ['code' => 'TT', 'codigo' => '868', 'name_es' => 'Trinidad y Tobago', 'name_en' => 'Trinidad and Tobago'],
            ['code' => 'TN', 'codigo' => '216', 'name_es' => 'Tunez', 'name_en' => 'Tunisia'],
            ['code' => 'TM', 'codigo' => '993', 'name_es' => 'Turkmenistán', 'name_en' => 'Turkmenistan'],
            ['code' => 'TR', 'codigo' => '090', 'name_es' => 'Turquía', 'name_en' => 'Turkey'],
            ['code' => 'TV', 'codigo' => '688', 'name_es' => 'Tuvalu', 'name_en' => 'Tuvalu'],
            ['code' => 'UA', 'codigo' => '380', 'name_es' => 'Ucrania', 'name_en' => 'Ukraine'],
            ['code' => 'UG', 'codigo' => '256', 'name_es' => 'Uganda', 'name_en' => 'Uganda'],
            ['code' => 'UY', 'codigo' => '598', 'name_es' => 'Uruguay', 'name_en' => 'Uruguay'],
            ['code' => 'UZ', 'codigo' => '998', 'name_es' => 'Uzbekistán', 'name_en' => 'Uzbekistan'],
            ['code' => 'VU', 'codigo' => '678', 'name_es' => 'Vanuatu', 'name_en' => 'Vanuatu'],
            ['code' => 'VE', 'codigo' => '058', 'name_es' => 'Venezuela', 'name_en' => 'Venezuela'],
            ['code' => 'VN', 'codigo' => '084', 'name_es' => 'Vietnam', 'name_en' => 'Vietnam'],
            ['code' => 'WF', 'codigo' => '681', 'name_es' => 'Wallis y Futuna', 'name_en' => 'Wallis and Futuna'],
            ['code' => 'YE', 'codigo' => '967', 'name_es' => 'Yemen', 'name_en' => 'Yemen'],
            ['code' => 'DJ', 'codigo' => '253', 'name_es' => 'Yibuti', 'name_en' => 'Djibouti'],
            ['code' => 'ZM', 'codigo' => '260', 'name_es' => 'Zambia', 'name_en' => 'Zambia'],
            ['code' => 'ZW', 'codigo' => '263', 'name_es' => 'Zimbabue', 'name_en' => 'Zimbabwe']
        ];

        DB::table('paises')->insert($countries);
    }
}
