<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run(): void
    {
        $properties = [
            [
                'id' => 'costa-del-sol',
                'name_es' => 'Apartamento Costa del Sol',
                'name_en' => 'Costa del Sol Apartment',
                'description_es' => 'Precioso apartamento en primera línea de playa con vistas al Mediterráneo. Totalmente equipado con cocina moderna, terraza privada y acceso directo a la playa. Ideal para familias y parejas que buscan unas vacaciones de sol y mar.',
                'description_en' => 'Beautiful beachfront apartment with Mediterranean views. Fully equipped with modern kitchen, private terrace and direct beach access. Ideal for families and couples looking for a sun and sea holiday.',
                'address' => 'Paseo Marítimo 42, Málaga, España',
                'location_lat' => 36.7213,
                'location_lon' => -4.4214,
                'price_per_night' => 8500,
                'min_nights' => 2,
                'max_guests' => 4,
                'amenities_es' => ['WiFi', 'Aire acondicionado', 'Piscina comunitaria', 'Parking privado', 'Terraza', 'Lavadora', 'Lavavajillas', 'TV Smart', 'Ropa de cama', 'Toallas'],
                'amenities_en' => ['WiFi', 'Air conditioning', 'Community pool', 'Private parking', 'Terrace', 'Washing machine', 'Dishwasher', 'Smart TV', 'Bed linen', 'Towels'],
                'house_rules_es' => "Check-in: 15:00 - 21:00\nCheck-out: antes de las 11:00\nNo se permiten fiestas\nNo fumar dentro del apartamento\nMascotas bajo consulta",
                'house_rules_en' => "Check-in: 3:00 PM - 9:00 PM\nCheck-out: before 11:00 AM\nNo parties allowed\nNo smoking inside the apartment\nPets on request",
                'wifi_name' => 'SolStay-Costa',
                'wifi_password' => 'playa2026',
                'checkin_instructions_es' => "1. Recoger llaves en la recepción del edificio\n2. Planta 3, puerta B\n3. El parking es la plaza P-12 en el sótano\n4. Código portal: 4527",
                'checkin_instructions_en' => "1. Pick up keys at the building reception\n2. Floor 3, door B\n3. Parking spot P-12 in the basement\n4. Door code: 4527",
                'checkout_instructions_es' => "1. Dejar llaves en el buzón de recepción\n2. Sacar la basura al contenedor\n3. Cerrar ventanas y apagar el aire",
                'checkout_instructions_en' => "1. Leave keys in the reception mailbox\n2. Take out the trash\n3. Close windows and turn off AC",
                'local_tips_es' => ['Chiringuito El Faro (5 min andando) - mejor pescaíto frito', 'Mercado Central de Atarazanas - productos frescos', 'Calle Larios - zona de compras', 'Alcazaba y Gibralfaro - visitas imprescindibles'],
                'local_tips_en' => ['Chiringuito El Faro (5 min walk) - best fried fish', 'Atarazanas Central Market - fresh produce', 'Calle Larios - shopping area', 'Alcazaba and Gibralfaro - must-see visits'],
            ],
            [
                'id' => 'sierra-nevada',
                'name_es' => 'Casa Rural Sierra Nevada',
                'name_en' => 'Sierra Nevada Country House',
                'description_es' => 'Encantadora casa rural con chimenea y jardín privado a los pies de Sierra Nevada. Tres dormitorios amplios, cocina rústica totalmente equipada y zona de barbacoa. Perfecta para escapadas en familia o con amigos en cualquier época del año.',
                'description_en' => 'Charming country house with fireplace and private garden at the foot of Sierra Nevada. Three spacious bedrooms, fully equipped rustic kitchen and BBQ area. Perfect for family or friends getaways any time of year.',
                'address' => 'Camino de la Sierra 15, Monachil, Granada, España',
                'location_lat' => 37.1283,
                'location_lon' => -3.5346,
                'price_per_night' => 12000,
                'min_nights' => 2,
                'max_guests' => 6,
                'amenities_es' => ['WiFi', 'Chimenea', 'Jardín privado', 'Barbacoa', 'Parking', 'Calefacción central', 'Cocina completa', 'TV Smart', 'Ropa de cama', 'Toallas', 'Leña incluida'],
                'amenities_en' => ['WiFi', 'Fireplace', 'Private garden', 'BBQ', 'Parking', 'Central heating', 'Full kitchen', 'Smart TV', 'Bed linen', 'Towels', 'Firewood included'],
                'house_rules_es' => "Check-in: 16:00 - 22:00\nCheck-out: antes de las 12:00\nNo se permiten fiestas\nRespetar el descanso de los vecinos\nMascotas bienvenidas (máximo 2)",
                'house_rules_en' => "Check-in: 4:00 PM - 10:00 PM\nCheck-out: before 12:00 PM\nNo parties allowed\nRespect neighbors' rest\nPets welcome (max 2)",
                'wifi_name' => 'SolStay-Sierra',
                'wifi_password' => 'montana2026',
                'checkin_instructions_es' => "1. Las llaves están en la caja de seguridad junto a la puerta\n2. Código: 7834\n3. Encender la calefacción con el termostato del salón\n4. La leña está en el cobertizo del jardín",
                'checkin_instructions_en' => "1. Keys are in the lockbox next to the door\n2. Code: 7834\n3. Turn on heating with the living room thermostat\n4. Firewood is in the garden shed",
                'checkout_instructions_es' => "1. Dejar llaves en la caja de seguridad\n2. Apagar calefacción y chimenea\n3. Cerrar todas las ventanas y puertas\n4. Basura en el contenedor de la esquina",
                'checkout_instructions_en' => "1. Leave keys in the lockbox\n2. Turn off heating and fireplace\n3. Close all windows and doors\n4. Trash in the corner container",
                'local_tips_es' => ['Estación de esquí Sierra Nevada (15 min)', 'Ruta de senderismo Los Cahorros (10 min)', 'Restaurante La Cantina de Diego - comida casera', 'Granada centro (20 min en coche) - Alhambra'],
                'local_tips_en' => ['Sierra Nevada ski resort (15 min)', 'Los Cahorros hiking trail (10 min)', 'Restaurante La Cantina de Diego - homemade food', 'Granada center (20 min drive) - Alhambra'],
            ],
        ];

        foreach ($properties as $data) {
            $id = $data['id'];
            unset($data['id']);
            Property::updateOrCreate(['id' => $id], $data);
        }
    }
}
