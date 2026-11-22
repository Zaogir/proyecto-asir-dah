# Internet of Things (ESP32 + ESPHome + Home Assistant)

Un ESP32 amb diversos sensors s'integra amb **Home Assistant** mitjançant **ESPHome**; les dades es
guarden en una base de dades **MariaDB** (contenidor) externa a Home Assistant i es mostren en pàgines web.

## Connexions i components

| Component | Plataforma ESPHome | Connexió |
|---|---|---|
| Relé (encén/apaga una bombeta) | `switch` amb `inverted: true` | GPIO 27 |
| Sensor de moviment | `binary_sensor` | GPIO 13 |
| Sensor de fum / CO2 | `adc` (lectura cada 10 s, filtre ×3,3 per al %) | GPIO 39 |
| Temperatura i humitat | `aht10` (bus I2C, `update_interval: 5s`) | SDA/SCL (I2C) |
| Pantalla | `ssd1306_i2c` (mateix bus I2C; mostra temp./humitat i *Detected/Clear*) | SDA/SCL (I2C) |
| Brunzidor (alarma) | buzzer; la melodia s'envia amb `song_str` des de l'automatització | GPIO 16 |

## Estat
El fitxer YAML d'ESPHome i els scripts d'inserció a la base de dades només apareixen com a captures
a la memòria (apartats 8.1, 8.2 i 8.3); **pendent de transcriure** i afegir a aquesta carpeta.
