<?php

namespace Database\Seeders;

use App\Models\Pais;
use App\Models\Departamento;
use App\Models\Ciudad;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PaisesDepartamentosCiudadesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Crear países de Suramérica
        $paisesSurAmerica = ['Colombia', 'Argentina', 'Brasil', 'Chile', 'Ecuador', 'Perú', 'Uruguay', 'Paraguay', 'Venezuela', 'Bolivia'];

        foreach ($paisesSurAmerica as $nombrePais) {
            $pais = Pais::create(['nombre' => $nombrePais]);

            // Agregar departamentos y ciudades solo para Colombia
            if ($nombrePais == 'Colombia') {

                $departamentos = [
                    'Amazonas' => ['Leticia', 'Puerto Nariño', 'La Chorrera', 'La Pedrera', 'Mirití-Paraná', 'Puerto Alegría', 'Puerto Arica', 'Puerto Santander', 'Tarapacá', 'El Encanto', 'Puerto Córdova'],
                    'Antioquia' => ['Medellín', 'Envigado', 'Bello', 'Itagüí', 'Rionegro', 'Sabaneta', 'Apartadó', 'Turbo', 'La Ceja', 'Copacabana', 'Caucasia', 'Caldas', 'Marinilla', 'El Carmen de Viboral', 'Santuario', 'Amagá', 'Santa Fe de Antioquia', 'Puerto Berrío', 'Carepa', 'Guarne', 'El Retiro', 'Yarumal', 'La Estrella', 'Girardota', 'Andes', 'Cisneros', 'El Bagre', 'Fredonia', 'Frontino', 'Ituango', 'Jardín', 'Jericó', 'Nechí', 'San Jerónimo', 'Sonsón', 'Tarazá', 'Valdivia', 'Zaragoza', 'Abejorral', 'Angostura', 'Anorí', 'Arboletes', 'Argelia', 'Barbosa', 'Betania', 'Betulia', 'Briceño', 'Buriticá', 'Cáceres', 'Caicedo', 'Campamento', 'Cañasgordas', 'Caracolí', 'Caramanta', 'Carolina', 'Dabeiba', 'Don Matías', 'Ebéjico', 'El Peñol', 'Entrerríos', 'Gómez Plata', 'Granada', 'Heliconia', 'Hispania', 'La Pintada', 'La Unión', 'Liborina', 'Maceo', 'Montebello', 'Murindó', 'Mutatá', 'Nariño', 'Olaya', 'Peque', 'Pueblorrico', 'Puerto Nare', 'Puerto Triunfo', 'Remedios', 'Sabanalarga', 'Salgar', 'San Andrés de Cuerquia', 'San Carlos', 'San Francisco', 'San Luis', 'San Pedro de Urabá', 'San Rafael', 'San Roque', 'San Vicente', 'Santa Bárbara', 'Santa Rosa de Osos', 'Santo Domingo', 'Segovia', 'Támesis', 'Titiribí', 'Toledo', 'Uramita', 'Urrao', 'Valparaíso', 'Vegachí', 'Venecia', 'Vigía del Fuerte', 'Yalí', 'Yolombó', 'Yondó', 'Amalfi', 'Anzá', 'Sopetrán'],
                    'Arauca' => ['Arauca', 'Arauquita', 'Cravo Norte', 'Fortul', 'Puerto Rondón', 'Saravena', 'Tame'],
                    'Atlántico' => ['Barranquilla', 'Soledad', 'Malambo', 'Sabanagrande', 'Puerto Colombia', 'Galapa', 'Baranoa', 'Sabanalarga', 'Polonuevo', 'Ponedera', 'Palmar de Varela', 'Campo de la Cruz', 'Repelón', 'Tubará', 'Luruaco', 'Usiacurí', 'Juan de Acosta', 'Santo Tomás', 'Santa Lucía', 'Manatí', 'Candelaria', 'Piojó', 'Suan'],
                    'Bolívar' => ['Cartagena', 'Magangué', 'El Carmen de Bolívar', 'Arjona', 'Turbaco', 'San Juan Nepomuceno', 'San Jacinto', 'María la Baja', 'Cantagallo', 'San Estanislao', 'Santa Rosa', 'Soplaviento', 'San Martín de Loba', 'San Pablo', 'Santa Catalina', 'Santa Rosa del Sur', 'San Fernando', 'San Jacinto del Cauca', 'Zambrano', 'Regidor', 'Río Viejo', 'Tiquisio', 'Villanueva', 'Arenal', 'Altos del Rosario', 'Arroyohondo', 'Barranco de Loba', 'Calamar', 'Cicuco', 'Clemencia', 'Córdoba', 'El Guamo', 'El Peñón', 'Hatillo de Loba', 'Mahates', 'Margarita', 'Montecristo', 'Morales', 'Pinillos', 'Simití', 'Talaigua Nuevo'],
                    'Boyacá' => ['Tunja', 'Duitama', 'Sogamoso', 'Chiquinquirá', 'Puerto Boyacá', 'Paipa', 'Moniquirá', 'Villa de Leyva', 'Soatá', 'Toca', 'Tuta', 'Tutazá', 'Umbita', 'Ventaquemada', 'Viracachá', 'Arcabuco', 'Belén', 'Berbeo', 'Betéitiva', 'Boavita', 'Briceño', 'Buenavista', 'Busbanzá', 'Caldas', 'Campohermoso', 'Cerinza', 'Chinavita', 'Chiscas', 'Chita', 'Chitaraque', 'Chivatá', 'Chivor', 'Ciénega', 'Cómbita', 'Coper', 'Corrales', 'Covarachía', 'Cubará', 'Cucaita', 'Cuítiva', 'El Cocuy', 'El Espino', 'Firavitoba', 'Floresta', 'Gachantivá', 'Gameza', 'Garagoa', 'Guacamayas', 'Guateque', 'Guayatá', 'Guican', 'Iza', 'Jenesano', 'Jericó', 'La Capilla', 'La Uvita', 'La Victoria', 'Labranzagrande', 'Macanal', 'Maripí', 'Miraflores', 'Mongua', 'Monguí', 'Motavita', 'Muzo', 'Nobsa', 'Nuevo Colón', 'Oicatá', 'Otanche', 'Pachavita', 'Páez', 'Pajarito', 'Panqueba', 'Pauna', 'Paya', 'Paz de Río', 'Pesca', 'Pisba', 'Quípama', 'Ramiriquí', 'Ráquira', 'Rondón', 'Saboyá', 'Sáchica', 'Samacá', 'San Eduardo', 'San José de Pare', 'San Luis de Gaceno', 'San Mateo', 'San Miguel de Sema', 'San Pablo de Borbur', 'Santa María', 'Santa Rosa de Viterbo', 'Santa Sofía', 'Santana', 'Sativanorte', 'Sativasur', 'Siachoque', 'Socha', 'Socotá', 'Somondoco', 'Sora', 'Soracá', 'Sotaquirá', 'Susacón', 'Sutamarchán', 'Sutatenza', 'Tasco', 'Tenza', 'Tibaná', 'Tibasosa', 'Tinjacá', 'Tipacoque', 'Togüí', 'Tópaga', 'Tota', 'Tununguá', 'Turmequé', 'Zetaquira'],
                    'Caldas' => ['Manizales', 'La Dorada', 'Chinchiná', 'Villamaría', 'Riosucio', 'Aguadas', 'Anserma', 'Salamina', 'Pácora', 'Neira', 'Supía', 'Marmato', 'Marquetalia', 'Pensilvania', 'Manzanares', 'Norcasia', 'Samaná', 'Victoria', 'Viterbo'],
                    'Caquetá' => ['Florencia', 'San Vicente del Caguán', 'Albania', 'Belén de los Andaquíes', 'Cartagena del Chairá', 'Curillo', 'El Doncello', 'El Paujil', 'La Montañita', 'Milán', 'Morelia', 'Puerto Rico', 'San José del Fragua', 'Solano', 'Solita', 'Valparaíso'],
                    'Casanare' => ['Yopal', 'Aguazul', 'Villanueva', 'Tauramena', 'Paz de Ariporo', 'Maní', 'Monterrey', 'Trinidad', 'Orocué', 'Hato Corozal', 'Nunchía', 'Recetor', 'Sabanalarga', 'Sácama', 'Támara'],
                    'Cauca' => ['Popayán', 'Santander de Quilichao', 'Patía', 'Cajibío', 'Puerto Tejada', 'Miranda', 'Piendamó', 'Villa Rica', 'Corinto', 'El Tambo', 'Guachené', 'Inzá', 'Morales', 'Padilla', 'Puracé', 'Rosas', 'Suárez', 'Timbío', 'Totoró', 'Almaguer', 'Argelia', 'Balboa', 'Bolívar', 'Buenos Aires', 'Caloto', 'Candelaria', 'Florencia', 'La Sierra', 'Mercaderes', 'Páez', 'Piamonte', 'San Sebastián', 'Santa Rosa', 'Silvia', 'Sotará', 'Sucre', 'Timbiquí', 'Toribío'],
                    'Cesar' => ['Valledupar', 'Aguachica', 'Agustín Codazzi', 'Bosconia', 'Chimichagua', 'El Copey', 'La Jagua de Ibirico', 'La Paz', 'Manaure', 'Pailitas', 'Pelaya', 'Pueblo Bello', 'Río de Oro', 'San Alberto', 'San Diego', 'San Martín', 'Tamalameque'],
                    'Chocó' => ['Quibdó', 'Acandí', 'Bahía Solano', 'Bajo Baudó', 'Bojayá', 'Cértegui', 'Condoto', 'El Carmen de Atrato', 'Istmina', 'Juradó', 'Lloró', 'Medio Atrato', 'Medio Baudó', 'Medio San Juan', 'Nóvita', 'Nuquí', 'Río Iró', 'Río Quito', 'Riosucio', 'San José del Palmar', 'Sipí', 'Tadó', 'Unguía', 'Unión Panamericana'],
                    'Córdoba' => ['Montería', 'Ayapel', 'Buenavista', 'Canalete', 'Cereté', 'Chimá', 'Chinú', 'Ciénaga de Oro', 'Cotorra', 'La Apartada', 'Lorica', 'Los Córdobas', 'Momil', 'Montelíbano', 'Moñitos', 'Planeta Rica', 'Pueblo Nuevo', 'Puerto Escondido', 'Puerto Libertador', 'Purísima', 'Sahagún', 'San Andrés Sotavento', 'San Antero', 'San Bernardo del Viento', 'San Carlos', 'San Pelayo', 'Tierralta', 'Tuchín', 'Valencia'],
                    'Cundinamarca' => ['Bogotá', 'Soacha', 'Facatativá', 'Zipaquirá', 'Girardot', 'Mosquera', 'Chía', 'Funza', 'Madrid', 'Cajicá', 'Fusagasugá', 'Tocancipá', 'Gachancipá', 'La Calera', 'Sopó', 'Tabio', 'Tenjo', 'Tolima', 'Ubaté', 'Cota', 'El Rosal', 'La Mesa', 'Anapoima', 'Guaduas', 'Guatavita', 'Nemocón', 'Nilo', 'Pacho', 'San Francisco', 'Supatá', 'Suesca', 'Tausa', 'Tibacuy', 'Tocaima', 'Vergara', 'Vianí', 'Villagómez', 'Villapinzón', 'Villeta', 'Viotá', 'Yacopí', 'Zipacón'],
                    'Guainía' => ['Inírida', 'Barranco Minas', 'Mapiripana', 'San Felipe'],
                    'Guaviare' => ['San José del Guaviare', 'Calamar', 'El Retorno', 'Miraflores'],
                    'Huila' => ['Neiva', 'Pitalito', 'Garzón', 'Campoalegre', 'La Plata', 'Palermo', 'Yaguará', 'Acevedo', 'Agrado', 'Aipe', 'Algeciras', 'Altamira', 'Baraya', 'Colombia', 'Elías', 'Gigante', 'Guadalupe', 'Hobo', 'Iquira', 'Isnos', 'La Argentina', 'Nátaga', 'Oporapa', 'Paicol', 'Palestina', 'Pital', 'Rivera', 'Saladoblanco', 'San Agustín', 'Santa María', 'Suaza', 'Tarqui', 'Tesalia', 'Tello', 'Teruel', 'Timaná', 'Villavieja'],
                    'La Guajira' => ['Riohacha', 'Maicao', 'Uribia', 'Manaure', 'Fonseca', 'Barrancas', 'San Juan del Cesar', 'Villanueva', 'Dibulla', 'Hatonuevo', 'Albania', 'El Molino', 'Urumita', 'La Jagua del Pilar'],
                    'Magdalena' => ['Santa Marta', 'Ciénaga', 'Fundación', 'Aracataca', 'El Banco', 'Algarrobo', 'Ariguaní', 'Chibolo', 'El Piñón', 'El Retén', 'Guamal', 'Pedraza', 'Pijiño del Carmen', 'Pivijay', 'Plato', 'Puebloviejo', 'Remolino', 'Salamina', 'San Sebastián de Buenavista', 'San Zenón', 'Santa Ana', 'Sitionuevo', 'Tenerife', 'Zapayán', 'Zona Bananera'],
                    'Meta' => ['Villavicencio', 'Acacías', 'Granada', 'Puerto López', 'Puerto Gaitán', 'Puerto Lleras', 'Puerto Rico', 'Restrepo', 'San Carlos de Guaroa', 'San Juan de Arama', 'San Juanito', 'San Martín', 'Vistahermosa', 'Cabuyaro', 'Cumaral', 'El Calvario', 'El Castillo', 'El Dorado', 'Mapiripán', 'Mesetas', 'La Macarena', 'Lejanías', 'Uribe', 'Barranca de Upía', 'Castilla la Nueva', 'Cubarral', 'Fuentedeoro', 'Guamal'],
                    'Nariño' => ['Pasto', 'Tumaco', 'Ipiales', 'Túquerres', 'Samaniego', 'La Unión', 'San Pablo', 'San Lorenzo', 'El Charco', 'Barbacoas', 'La Cruz', 'El Rosario', 'Leiva', 'Olaya Herrera', 'San Bernardo', 'San Pedro de Cartago', 'Consacá', 'Cumbal', 'Imués', 'Policarpa', 'Potosí', 'Providencia', 'Sandoná', 'Santacruz', 'Sapuyes', 'Arboleda', 'Buesaco', 'Colón', 'Contadero', 'Córdoba', 'Cuaspud', 'Cumbitara', 'El Peñol', 'El Tablón de Gómez', 'El Tambo', 'Funes', 'Guachucal', 'Guaitarilla', 'Gualmatán', 'Iles', 'La Florida', 'La Llanada', 'La Tola', 'La Victoria', 'Magüí', 'Mallama', 'Mosquera', 'Nariño', 'Ospina', 'Francisco Pizarro', 'Puerres', 'Pupiales', 'Ricaurte', 'Roberto Payán', 'Taminango', 'Tangua', 'Yacuanquer'],
                    'Norte de Santander' => ['Cúcuta', 'Ocaña', 'Pamplona', 'Sardinata', 'Tibú', 'Villa del Rosario', 'Ábrego', 'Arboledas', 'Bochalema', 'Bucarasica', 'Cáchira', 'Cácota', 'Chinácota', 'Chitagá', 'Convención', 'Cucutilla', 'Durania', 'El Carmen', 'El Tarra', 'El Zulia', 'Gramalote', 'Hacarí', 'Herrán', 'La Esperanza', 'La Playa', 'Labateca', 'Los Patios', 'Lourdes', 'Mutiscua', 'Pamplonita', 'Puerto Santander', 'Ragonvalia', 'Salazar', 'San Calixto', 'San Cayetano', 'Santiago', 'Santo Domingo de Silos', 'Teorama', 'Villa Caro'],
                    'Putumayo' => ['Mocoa', 'Puerto Asís', 'Sibundoy', 'Villagarzón', 'Colón', 'Orito', 'Puerto Caicedo', 'Puerto Guzmán', 'Leguízamo', 'San Francisco'],
                    'Quindío' => ['Armenia', 'Calarcá', 'Circasia', 'Montenegro', 'La Tebaida', 'Salento', 'Buenavista', 'Córdoba', 'Filandia', 'Génova', 'Pijao', 'Quimbaya'],
                    'Risaralda' => ['Pereira', 'Dosquebradas', 'La Virginia', 'Santa Rosa de Cabal', 'Apía', 'Balboa', 'Belén de Umbría', 'Guática', 'La Celia', 'Marsella', 'Mistrató', 'Pueblo Rico', 'Quinchía', 'Santuario'],
                    'San Andrés y Providencia' => ['San Andrés', 'Providencia'],
                    'Santander' => ['Bucaramanga', 'Barrancabermeja', 'Floridablanca', 'Girón', 'Piedecuesta', 'Aratoca', 'Barbosa', 'Barichara', 'Bolívar', 'Cabrera', 'California', 'Capitanejo', 'Carcasí', 'Cepitá', 'Cerrito', 'Charalá', 'Charta', 'Chima', 'Chipatá', 'Cimitarra', 'Concepción', 'Confines', 'Contratación', 'Coromoro', 'Curití', 'El Carmen de Chucurí', 'El Guacamayo', 'El Peñón', 'El Playón', 'Encino', 'Enciso', 'Florián', 'Galán', 'Guaca', 'Guadalupe', 'Guapotá', 'Guavatá', 'Güepsa', 'Hato', 'Jesús María', 'Jordán', 'La Belleza', 'La Paz', 'Landázuri', 'Lebrija', 'Los Santos', 'Macaravita', 'Málaga', 'Matanza', 'Mogotes', 'Molagavita', 'Ocamonte', 'Oiba', 'Onzaga', 'Palmar', 'Palmas del Socorro', 'Páramo', 'Pinchote', 'Puente Nacional', 'Puerto Parra', 'Puerto Wilches', 'Rionegro', 'Sabana de Torres', 'San Andrés', 'San Benito', 'San Gil', 'San Joaquín', 'San José de Miranda', 'San Miguel', 'San Vicente de Chucurí', 'Santa Bárbara', 'Santa Helena del Opón', 'Simacota', 'Socorro', 'Suaita', 'Sucre', 'Suratá', 'Tona', 'Valle de San José', 'Vélez', 'Vetas', 'Villanueva', 'Zapatoca'],
                    'Sucre' => ['Sincelejo', 'Corozal', 'Sampués', 'San Marcos', 'San Onofre', 'San Benito Abad', 'Coveñas', 'Colosó', 'Morroa', 'Toluviejo', 'Tolú', 'Chalán', 'Guaranda', 'Los Palmitos', 'Majagual', 'Palmito', 'Santiago de Tolú', 'San Pedro', 'Sincé', 'Sucre'],
                    'Tolima' => ['Ibagué', 'Espinal', 'Flandes', 'Honda', 'Líbano', 'Mariquita', 'Melgar', 'Murillo', 'Natagaima', 'Ortega', 'Palocabildo', 'Piedras', 'Planadas', 'Prado', 'Purificación', 'Rioblanco', 'Roncesvalles', 'Rovira', 'Saldaña', 'San Antonio', 'San Luis', 'Santa Isabel', 'Suárez', 'Valle de San Juan', 'Venadillo', 'Villahermosa', 'Villarrica'],
                    'Valle del Cauca' => ['Cali', 'Buenaventura', 'Palmira', 'Tuluá', 'Yumbo', 'Buga', 'Cartago', 'Jamundí', 'La Unión', 'Roldanillo', 'Sevilla', 'Alcalá', 'Andalucía', 'Ansermanuevo', 'Argelia', 'Bolívar', 'Bugalagrande', 'Caicedonia', 'Calima', 'Candelaria', 'Dagua', 'El Águila', 'El Cairo', 'El Cerrito', 'El Dovio', 'Florida', 'Ginebra', 'Guacarí', 'La Cumbre', 'La Victoria', 'Obando', 'Pradera', 'Restrepo', 'Riofrío', 'San Pedro', 'Toro', 'Trujillo', 'Ulloa', 'Versalles', 'Vijes', 'Yotoco', 'Zarzal'],
                    'Vaupés' => ['Mitú', 'Caruru', 'Pacoa', 'Taraira', 'Papunaua', 'Yavaraté'],
                    'Vichada' => ['Puerto Carreño', 'La Primavera', 'Santa Rosalía', 'Cumaribo']
                ];


                foreach ($departamentos as $nombreDepto => $ciudades) {
                    $departamento = Departamento::create([
                        'nombre' => $nombreDepto,
                        'pais_id' => $pais->id,
                    ]);

                    foreach ($ciudades as $nombreCiudad) {
                        Ciudad::create([
                            'nombre' => $nombreCiudad,
                            'departamento_id' => $departamento->id,
                        ]);
                    }
                }
            }
        }
    }
}
