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
        DB::table('countries')->truncate();

        $countries = [
            ['code' => 'AF', 'name_es' => 'Afganistán', 'name_en' => 'Afghanistan'],
            ['code' => 'AL', 'name_es' => 'Albania', 'name_en' => 'Albania'],
            ['code' => 'DE', 'name_es' => 'Alemania', 'name_en' => 'Germany'],
            ['code' => 'DZ', 'name_es' => 'Algeria', 'name_en' => 'Algeria'],
            ['code' => 'AD', 'name_es' => 'Andorra', 'name_en' => 'Andorra'],
            ['code' => 'AO', 'name_es' => 'Angola', 'name_en' => 'Angola'],
            ['code' => 'AI', 'name_es' => 'Anguila', 'name_en' => 'Anguilla'],
            ['code' => 'AQ', 'name_es' => 'Antártida', 'name_en' => 'Antarctica'],
            ['code' => 'AG', 'name_es' => 'Antigua y Barbuda', 'name_en' => 'Antigua and Barbuda'],
            ['code' => 'AN', 'name_es' => 'Antillas Neerlandesas', 'name_en' => 'Netherlands Antilles'],
            ['code' => 'SA', 'name_es' => 'Arabia Saudita', 'name_en' => 'Saudi Arabia'],
            ['code' => 'AR', 'name_es' => 'Argentina', 'name_en' => 'Argentina'],
            ['code' => 'AM', 'name_es' => 'Armenia', 'name_en' => 'Armenia'],
            ['code' => 'AW', 'name_es' => 'Aruba', 'name_en' => 'Aruba'],
            ['code' => 'AU', 'name_es' => 'Australia', 'name_en' => 'Australia'],
            ['code' => 'AT', 'name_es' => 'Austria', 'name_en' => 'Austria'],
            ['code' => 'AZ', 'name_es' => 'Azerbaiyán', 'name_en' => 'Azerbaijan'],
            ['code' => 'BE', 'name_es' => 'Bélgica', 'name_en' => 'Belgium'],
            ['code' => 'BS', 'name_es' => 'Bahamas', 'name_en' => 'Bahamas'],
            ['code' => 'BH', 'name_es' => 'Bahréin', 'name_en' => 'Bahrain'],
            ['code' => 'BD', 'name_es' => 'Bangladesh', 'name_en' => 'Bangladesh'],
            ['code' => 'BB', 'name_es' => 'Barbados', 'name_en' => 'Barbados'],
            ['code' => 'BZ', 'name_es' => 'Belice', 'name_en' => 'Belize'],
            ['code' => 'BJ', 'name_es' => 'Benín', 'name_en' => 'Benin'],
            ['code' => 'BT', 'name_es' => 'Bután', 'name_en' => 'Bhutan'],
            ['code' => 'BY', 'name_es' => 'Bielorrusia', 'name_en' => 'Belarus'],
            ['code' => 'MM', 'name_es' => 'Birmania', 'name_en' => 'Myanmar'],
            ['code' => 'BO', 'name_es' => 'Bolivia', 'name_en' => 'Bolivia'],
            ['code' => 'BA', 'name_es' => 'Bosnia y Herzegovina', 'name_en' => 'Bosnia and Herzegovina'],
            ['code' => 'BW', 'name_es' => 'Botsuana', 'name_en' => 'Botswana'],
            ['code' => 'BR', 'name_es' => 'Brasil', 'name_en' => 'Brazil'],
            ['code' => 'BN', 'name_es' => 'Brunéi', 'name_en' => 'Brunei'],
            ['code' => 'BG', 'name_es' => 'Bulgaria', 'name_en' => 'Bulgaria'],
            ['code' => 'BF', 'name_es' => 'Burkina Faso', 'name_en' => 'Burkina Faso'],
            ['code' => 'BI', 'name_es' => 'Burundi', 'name_en' => 'Burundi'],
            ['code' => 'CV', 'name_es' => 'Cabo Verde', 'name_en' => 'Cape Verde'],
            ['code' => 'KH', 'name_es' => 'Camboya', 'name_en' => 'Cambodia'],
            ['code' => 'CM', 'name_es' => 'Camerún', 'name_en' => 'Cameroon'],
            ['code' => 'CA', 'name_es' => 'Canadá', 'name_en' => 'Canada'],
            ['code' => 'TD', 'name_es' => 'Chad', 'name_en' => 'Chad'],
            ['code' => 'CL', 'name_es' => 'Chile', 'name_en' => 'Chile'],
            ['code' => 'CN', 'name_es' => 'China', 'name_en' => 'China'],
            ['code' => 'CY', 'name_es' => 'Chipre', 'name_en' => 'Cyprus'],
            ['code' => 'VA', 'name_es' => 'Ciudad del Vaticano', 'name_en' => 'Vatican City State'],
            ['code' => 'CO', 'name_es' => 'Colombia', 'name_en' => 'Colombia'],
            ['code' => 'KM', 'name_es' => 'Comoras', 'name_en' => 'Comoros'],
            ['code' => 'CG', 'name_es' => 'Congo', 'name_en' => 'Congo'],
            ['code' => 'KP', 'name_es' => 'Corea del Norte', 'name_en' => 'North Korea'],
            ['code' => 'KR', 'name_es' => 'Corea del Sur', 'name_en' => 'South Korea'],
            ['code' => 'CI', 'name_es' => 'Costa de Marfil', 'name_en' => 'Ivory Coast'],
            ['code' => 'CR', 'name_es' => 'Costa Rica', 'name_en' => 'Costa Rica'],
            ['code' => 'HR', 'name_es' => 'Croacia', 'name_en' => 'Croatia'],
            ['code' => 'CU', 'name_es' => 'Cuba', 'name_en' => 'Cuba'],
            ['code' => 'DK', 'name_es' => 'Dinamarca', 'name_en' => 'Denmark'],
            ['code' => 'DM', 'name_es' => 'Dominica', 'name_en' => 'Dominica'],
            ['code' => 'EC', 'name_es' => 'Ecuador', 'name_en' => 'Ecuador'],
            ['code' => 'EG', 'name_es' => 'Egipto', 'name_en' => 'Egypt'],
            ['code' => 'SV', 'name_es' => 'El Salvador', 'name_en' => 'El Salvador'],
            ['code' => 'AE', 'name_es' => 'Emiratos Árabes Unidos', 'name_en' => 'United Arab Emirates'],
            ['code' => 'ER', 'name_es' => 'Eritrea', 'name_en' => 'Eritrea'],
            ['code' => 'SK', 'name_es' => 'Eslovaquia', 'name_en' => 'Slovakia'],
            ['code' => 'SI', 'name_es' => 'Eslovenia', 'name_en' => 'Slovenia'],
            ['code' => 'ES', 'name_es' => 'España', 'name_en' => 'Spain'],
            ['code' => 'US', 'name_es' => 'Estados Unidos de América', 'name_en' => 'United States of America'],
            ['code' => 'EE', 'name_es' => 'Estonia', 'name_en' => 'Estonia'],
            ['code' => 'ET', 'name_es' => 'Etiopía', 'name_en' => 'Ethiopia'],
            ['code' => 'PH', 'name_es' => 'Filipinas', 'name_en' => 'Philippines'],
            ['code' => 'FI', 'name_es' => 'Finlandia', 'name_en' => 'Finland'],
            ['code' => 'FJ', 'name_es' => 'Fiyi', 'name_en' => 'Fiji'],
            ['code' => 'FR', 'name_es' => 'Francia', 'name_en' => 'France'],
            ['code' => 'GA', 'name_es' => 'Gabón', 'name_en' => 'Gabon'],
            ['code' => 'GM', 'name_es' => 'Gambia', 'name_en' => 'Gambia'],
            ['code' => 'GE', 'name_es' => 'Georgia', 'name_en' => 'Georgia'],
            ['code' => 'GH', 'name_es' => 'Ghana', 'name_en' => 'Ghana'],
            ['code' => 'GI', 'name_es' => 'Gibraltar', 'name_en' => 'Gibraltar'],
            ['code' => 'GD', 'name_es' => 'Granada', 'name_en' => 'Grenada'],
            ['code' => 'GR', 'name_es' => 'Grecia', 'name_en' => 'Greece'],
            ['code' => 'GL', 'name_es' => 'Groenlandia', 'name_en' => 'Greenland'],
            ['code' => 'GP', 'name_es' => 'Guadalupe', 'name_en' => 'Guadeloupe'],
            ['code' => 'GU', 'name_es' => 'Guam', 'name_en' => 'Guam'],
            ['code' => 'GT', 'name_es' => 'Guatemala', 'name_en' => 'Guatemala'],
            ['code' => 'GF', 'name_es' => 'Guayana Francesa', 'name_en' => 'French Guiana'],
            ['code' => 'GG', 'name_es' => 'Guernesey', 'name_en' => 'Guernsey'],
            ['code' => 'GN', 'name_es' => 'Guinea', 'name_en' => 'Guinea'],
            ['code' => 'GQ', 'name_es' => 'Guinea Ecuatorial', 'name_en' => 'Equatorial Guinea'],
            ['code' => 'GW', 'name_es' => 'Guinea-Bissau', 'name_en' => 'Guinea-Bissau'],
            ['code' => 'GY', 'name_es' => 'Guyana', 'name_en' => 'Guyana'],
            ['code' => 'HT', 'name_es' => 'Haití', 'name_en' => 'Haiti'],
            ['code' => 'HN', 'name_es' => 'Honduras', 'name_en' => 'Honduras'],
            ['code' => 'HK', 'name_es' => 'Hong Kong', 'name_en' => 'Hong Kong'],
            ['code' => 'HU', 'name_es' => 'Hungría', 'name_en' => 'Hungary'],
            ['code' => 'IN', 'name_es' => 'India', 'name_en' => 'India'],
            ['code' => 'ID', 'name_es' => 'Indonesia', 'name_en' => 'Indonesia'],
            ['code' => 'IR', 'name_es' => 'Irán', 'name_en' => 'Iran'],
            ['code' => 'IQ', 'name_es' => 'Irak', 'name_en' => 'Iraq'],
            ['code' => 'IE', 'name_es' => 'Irlanda', 'name_en' => 'Ireland'],
            ['code' => 'BV', 'name_es' => 'Isla Bouvet', 'name_en' => 'Bouvet Island'],
            ['code' => 'IM', 'name_es' => 'Isla de Man', 'name_en' => 'Isle of Man'],
            ['code' => 'CX', 'name_es' => 'Isla de Navidad', 'name_en' => 'Christmas Island'],
            ['code' => 'NF', 'name_es' => 'Isla Norfolk', 'name_en' => 'Norfolk Island'],
            ['code' => 'IS', 'name_es' => 'Islandia', 'name_en' => 'Iceland'],
            ['code' => 'BM', 'name_es' => 'Islas Bermudas', 'name_en' => 'Bermuda Islands'],
            ['code' => 'KY', 'name_es' => 'Islas Caimán', 'name_en' => 'Cayman Islands'],
            ['code' => 'CC', 'name_es' => 'Islas Cocos (Keeling)', 'name_en' => 'Cocos (Keeling) Islands'],
            ['code' => 'CK', 'name_es' => 'Islas Cook', 'name_en' => 'Cook Islands'],
            ['code' => 'AX', 'name_es' => 'Islas de Åland', 'name_en' => 'Åland Islands'],
            ['code' => 'FO', 'name_es' => 'Islas Feroe', 'name_en' => 'Faroe Islands'],
            ['code' => 'GS', 'name_es' => 'Islas Georgias del Sur y Sandwich del Sur', 'name_en' => 'South Georgia and the South Sandwich Islands'],
            ['code' => 'HM', 'name_es' => 'Islas Heard y McDonald', 'name_en' => 'Heard Island and McDonald Islands'],
            ['code' => 'MV', 'name_es' => 'Islas Maldivas', 'name_en' => 'Maldives'],
            ['code' => 'FK', 'name_es' => 'Islas Malvinas', 'name_en' => 'Falkland Islands (Malvinas)'],
            ['code' => 'MP', 'name_es' => 'Islas Marianas del Norte', 'name_en' => 'Northern Mariana Islands'],
            ['code' => 'MH', 'name_es' => 'Islas Marshall', 'name_en' => 'Marshall Islands'],
            ['code' => 'PN', 'name_es' => 'Islas Pitcairn', 'name_en' => 'Pitcairn Islands'],
            ['code' => 'SB', 'name_es' => 'Islas Salomón', 'name_en' => 'Solomon Islands'],
            ['code' => 'TC', 'name_es' => 'Islas Turcas y Caicos', 'name_en' => 'Turks and Caicos Islands'],
            ['code' => 'UM', 'name_es' => 'Islas Ultramarinas Menores de Estados Unidos', 'name_en' => 'United States Minor Outlying Islands'],
            ['code' => 'VG', 'name_es' => 'Islas Vírgenes Británicas', 'name_en' => 'Virgin Islands'],
            ['code' => 'VI', 'name_es' => 'Islas Vírgenes de los Estados Unidos', 'name_en' => 'United States Virgin Islands'],
            ['code' => 'IL', 'name_es' => 'Israel', 'name_en' => 'Israel'],
            ['code' => 'IT', 'name_es' => 'Italia', 'name_en' => 'Italy'],
            ['code' => 'JM', 'name_es' => 'Jamaica', 'name_en' => 'Jamaica'],
            ['code' => 'JP', 'name_es' => 'Japón', 'name_en' => 'Japan'],
            ['code' => 'JE', 'name_es' => 'Jersey', 'name_en' => 'Jersey'],
            ['code' => 'JO', 'name_es' => 'Jordania', 'name_en' => 'Jordan'],
            ['code' => 'KZ', 'name_es' => 'Kazajistán', 'name_en' => 'Kazakhstan'],
            ['code' => 'KE', 'name_es' => 'Kenia', 'name_en' => 'Kenya'],
            ['code' => 'KG', 'name_es' => 'Kirguizistán', 'name_en' => 'Kyrgyzstan'],
            ['code' => 'KI', 'name_es' => 'Kiribati', 'name_en' => 'Kiribati'],
            ['code' => 'KW', 'name_es' => 'Kuwait', 'name_en' => 'Kuwait'],
            ['code' => 'LB', 'name_es' => 'Líbano', 'name_en' => 'Lebanon'],
            ['code' => 'LA', 'name_es' => 'Laos', 'name_en' => 'Laos'],
            ['code' => 'LS', 'name_es' => 'Lesoto', 'name_en' => 'Lesotho'],
            ['code' => 'LV', 'name_es' => 'Letonia', 'name_en' => 'Latvia'],
            ['code' => 'LR', 'name_es' => 'Liberia', 'name_en' => 'Liberia'],
            ['code' => 'LY', 'name_es' => 'Libia', 'name_en' => 'Libya'],
            ['code' => 'LI', 'name_es' => 'Liechtenstein', 'name_en' => 'Liechtenstein'],
            ['code' => 'LT', 'name_es' => 'Lituania', 'name_en' => 'Lithuania'],
            ['code' => 'LU', 'name_es' => 'Luxemburgo', 'name_en' => 'Luxembourg'],
            ['code' => 'MX', 'name_es' => 'México', 'name_en' => 'Mexico'],
            ['code' => 'MC', 'name_es' => 'Mónaco', 'name_en' => 'Monaco'],
            ['code' => 'MO', 'name_es' => 'Macao', 'name_en' => 'Macao'],
            ['code' => 'MK', 'name_es' => 'Macedonia', 'name_en' => 'Macedonia'],
            ['code' => 'MG', 'name_es' => 'Madagascar', 'name_en' => 'Madagascar'],
            ['code' => 'MY', 'name_es' => 'Malasia', 'name_en' => 'Malaysia'],
            ['code' => 'MW', 'name_es' => 'Malawi', 'name_en' => 'Malawi'],
            ['code' => 'ML', 'name_es' => 'Mali', 'name_en' => 'Mali'],
            ['code' => 'MT', 'name_es' => 'Malta', 'name_en' => 'Malta'],
            ['code' => 'MA', 'name_es' => 'Marruecos', 'name_en' => 'Morocco'],
            ['code' => 'MQ', 'name_es' => 'Martinica', 'name_en' => 'Martinique'],
            ['code' => 'MU', 'name_es' => 'Mauricio', 'name_en' => 'Mauritius'],
            ['code' => 'MR', 'name_es' => 'Mauritania', 'name_en' => 'Mauritania'],
            ['code' => 'YT', 'name_es' => 'Mayotte', 'name_en' => 'Mayotte'],
            ['code' => 'FM', 'name_es' => 'Micronesia', 'name_en' => 'Estados Federados de'],
            ['code' => 'MD', 'name_es' => 'Moldavia', 'name_en' => 'Moldova'],
            ['code' => 'MN', 'name_es' => 'Mongolia', 'name_en' => 'Mongolia'],
            ['code' => 'ME', 'name_es' => 'Montenegro', 'name_en' => 'Montenegro'],
            ['code' => 'MS', 'name_es' => 'Montserrat', 'name_en' => 'Montserrat'],
            ['code' => 'MZ', 'name_es' => 'Mozambique', 'name_en' => 'Mozambique'],
            ['code' => 'NA', 'name_es' => 'Namibia', 'name_en' => 'Namibia'],
            ['code' => 'NR', 'name_es' => 'Nauru', 'name_en' => 'Nauru'],
            ['code' => 'NP', 'name_es' => 'Nepal', 'name_en' => 'Nepal'],
            ['code' => 'NI', 'name_es' => 'Nicaragua', 'name_en' => 'Nicaragua'],
            ['code' => 'NE', 'name_es' => 'Níger', 'name_en' => 'Niger'],
            ['code' => 'NG', 'name_es' => 'Nigeria', 'name_en' => 'Nigeria'],
            ['code' => 'NU', 'name_es' => 'Niue', 'name_en' => 'Niue'],
            ['code' => 'NO', 'name_es' => 'Noruega', 'name_en' => 'Norway'],
            ['code' => 'NC', 'name_es' => 'Nueva Caledonia', 'name_en' => 'New Caledonia'],
            ['code' => 'NZ', 'name_es' => 'Nueva Zelanda', 'name_en' => 'New Zealand'],
            ['code' => 'OM', 'name_es' => 'Omán', 'name_en' => 'Oman'],
            ['code' => 'NL', 'name_es' => 'Países Bajos', 'name_en' => 'Netherlands'],
            ['code' => 'PK', 'name_es' => 'Pakistán', 'name_en' => 'Pakistan'],
            ['code' => 'PW', 'name_es' => 'Palau', 'name_en' => 'Palau'],
            ['code' => 'PS', 'name_es' => 'Palestina', 'name_en' => 'Palestine'],
            ['code' => 'PA', 'name_es' => 'Panamá', 'name_en' => 'Panama'],
            ['code' => 'PG', 'name_es' => 'Papúa Nueva Guinea', 'name_en' => 'Papua New Guinea'],
            ['code' => 'PY', 'name_es' => 'Paraguay', 'name_en' => 'Paraguay'],
            ['code' => 'PE', 'name_es' => 'Perú', 'name_en' => 'Peru'],
            ['code' => 'PF', 'name_es' => 'Polinesia Francesa', 'name_en' => 'French Polynesia'],
            ['code' => 'PL', 'name_es' => 'Polonia', 'name_en' => 'Poland'],
            ['code' => 'PT', 'name_es' => 'Portugal', 'name_en' => 'Portugal'],
            ['code' => 'PR', 'name_es' => 'Puerto Rico', 'name_en' => 'Puerto Rico'],
            ['code' => 'QA', 'name_es' => 'Qatar', 'name_en' => 'Qatar'],
            ['code' => 'GB', 'name_es' => 'Reino Unido', 'name_en' => 'United Kingdom'],
            ['code' => 'CF', 'name_es' => 'República Centroafricana', 'name_en' => 'Central African Republic'],
            ['code' => 'CZ', 'name_es' => 'República Checa', 'name_en' => 'Czech Republic'],
            ['code' => 'DO', 'name_es' => 'República Dominicana', 'name_en' => 'Dominican Republic'],
            ['code' => 'RE', 'name_es' => 'Reunión', 'name_en' => 'Réunion'],
            ['code' => 'RW', 'name_es' => 'Ruanda', 'name_en' => 'Rwanda'],
            ['code' => 'RO', 'name_es' => 'Rumanía', 'name_en' => 'Romania'],
            ['code' => 'RU', 'name_es' => 'Rusia', 'name_en' => 'Russia'],
            ['code' => 'EH', 'name_es' => 'Sahara Occidental', 'name_en' => 'Western Sahara'],
            ['code' => 'WS', 'name_es' => 'Samoa', 'name_en' => 'Samoa'],
            ['code' => 'AS', 'name_es' => 'Samoa Americana', 'name_en' => 'American Samoa'],
            ['code' => 'BL', 'name_es' => 'San Bartolomé', 'name_en' => 'Saint Barthélemy'],
            ['code' => 'KN', 'name_es' => 'San Cristóbal y Nieves', 'name_en' => 'Saint Kitts and Nevis'],
            ['code' => 'SM', 'name_es' => 'San Marino', 'name_en' => 'San Marino'],
            ['code' => 'MF', 'name_es' => 'San Martín (Francia)', 'name_en' => 'Saint Martin (French part)'],
            ['code' => 'PM', 'name_es' => 'San Pedro y Miquelón', 'name_en' => 'Saint Pierre and Miquelon'],
            ['code' => 'VC', 'name_es' => 'San Vicente y las Granadinas', 'name_en' => 'Saint Vincent and the Grenadines'],
            ['code' => 'SH', 'name_es' => 'Santa Elena', 'name_en' => 'Ascensión y Tristán de Acuña'],
            ['code' => 'LC', 'name_es' => 'Santa Lucía', 'name_en' => 'Saint Lucia'],
            ['code' => 'ST', 'name_es' => 'Santo Tomé y Príncipe', 'name_en' => 'Sao Tome and Principe'],
            ['code' => 'SN', 'name_es' => 'Senegal', 'name_en' => 'Senegal'],
            ['code' => 'RS', 'name_es' => 'Serbia', 'name_en' => 'Serbia'],
            ['code' => 'SC', 'name_es' => 'Seychelles', 'name_en' => 'Seychelles'],
            ['code' => 'SL', 'name_es' => 'Sierra Leona', 'name_en' => 'Sierra Leone'],
            ['code' => 'SG', 'name_es' => 'Singapur', 'name_en' => 'Singapore'],
            ['code' => 'SY', 'name_es' => 'Siria', 'name_en' => 'Syria'],
            ['code' => 'SO', 'name_es' => 'Somalia', 'name_en' => 'Somalia'],
            ['code' => 'LK', 'name_es' => 'Sri Lanka', 'name_en' => 'Sri Lanka'],
            ['code' => 'ZA', 'name_es' => 'Sudáfrica', 'name_en' => 'South Africa'],
            ['code' => 'SD', 'name_es' => 'Sudán', 'name_en' => 'Sudan'],
            ['code' => 'SE', 'name_es' => 'Suecia', 'name_en' => 'Sweden'],
            ['code' => 'CH', 'name_es' => 'Suiza', 'name_en' => 'Switzerland'],
            ['code' => 'SR', 'name_es' => 'Surinam', 'name_en' => 'Suriname'],
            ['code' => 'SJ', 'name_es' => 'Svalbard y Jan Mayen', 'name_en' => 'Svalbard and Jan Mayen'],
            ['code' => 'SZ', 'name_es' => 'Suazilandia', 'name_en' => 'Swaziland'],
            ['code' => 'TJ', 'name_es' => 'Tadjikistán', 'name_en' => 'Tajikistan'],
            ['code' => 'TH', 'name_es' => 'Tailandia', 'name_en' => 'Thailand'],
            ['code' => 'TW', 'name_es' => 'Taiwán', 'name_en' => 'Taiwan'],
            ['code' => 'TZ', 'name_es' => 'Tanzania', 'name_en' => 'Tanzania'],
            ['code' => 'IO', 'name_es' => 'Territorio Británico del Océano Índico', 'name_en' => 'British Indian Ocean Territory'],
            ['code' => 'TF', 'name_es' => 'Territorios Australes y Antárticas Franceses', 'name_en' => 'French Southern Territories'],
            ['code' => 'TL', 'name_es' => 'Timor Oriental', 'name_en' => 'East Timor'],
            ['code' => 'TG', 'name_es' => 'Togo', 'name_en' => 'Togo'],
            ['code' => 'TK', 'name_es' => 'Tokelau', 'name_en' => 'Tokelau'],
            ['code' => 'TO', 'name_es' => 'Tonga', 'name_en' => 'Tonga'],
            ['code' => 'TT', 'name_es' => 'Trinidad y Tobago', 'name_en' => 'Trinidad and Tobago'],
            ['code' => 'TN', 'name_es' => 'Túnez', 'name_en' => 'Tunisia'],
            ['code' => 'TM', 'name_es' => 'Turkmenistán', 'name_en' => 'Turkmenistan'],
            ['code' => 'TR', 'name_es' => 'Turquía', 'name_en' => 'Turkey'],
            ['code' => 'TV', 'name_es' => 'Tuvalu', 'name_en' => 'Tuvalu'],
            ['code' => 'UA', 'name_es' => 'Ucrania', 'name_en' => 'Ukraine'],
            ['code' => 'UG', 'name_es' => 'Uganda', 'name_en' => 'Uganda'],
            ['code' => 'UY', 'name_es' => 'Uruguay', 'name_en' => 'Uruguay'],
            ['code' => 'UZ', 'name_es' => 'Uzbekistán', 'name_en' => 'Uzbekistan'],
            ['code' => 'VU', 'name_es' => 'Vanuatu', 'name_en' => 'Vanuatu'],
            ['code' => 'VE', 'name_es' => 'Venezuela', 'name_en' => 'Venezuela'],
            ['code' => 'VN', 'name_es' => 'Vietnam', 'name_en' => 'Vietnam'],
            ['code' => 'WF', 'name_es' => 'Wallis y Futuna', 'name_en' => 'Wallis and Futuna'],
            ['code' => 'YE', 'name_es' => 'Yemen', 'name_en' => 'Yemen'],
            ['code' => 'DJ', 'name_es' => 'Yibuti', 'name_en' => 'Djibouti'],
            ['code' => 'ZM', 'name_es' => 'Zambia', 'name_en' => 'Zambia'],
            ['code' => 'ZW', 'name_es' => 'Zimbabue', 'name_en' => 'Zimbabwe']
        ];

        DB::table('countries')->insert($countries);
    }
}
