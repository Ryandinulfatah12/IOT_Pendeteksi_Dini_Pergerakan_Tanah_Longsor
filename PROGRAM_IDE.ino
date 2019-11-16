

#include <MPU6050.h>

/**
 * BasicHTTPClient.ino
 *
 *  Created on: 24.05.2015
 *
 */
#include <ESP8266WiFi.h>
#include <ESP8266WiFiMulti.h>
#include <ESP8266HTTPClient.h>

#define USE_SERIAL Serial
#define sensorPin A0  // pin sensor kelembapan tanah
const int vs = 16; //sensor getar
const int pinBuzzer = 12;
const int led = 13;
boolean data;
MPU6050 mpu;
ESP8266WiFiMulti WiFiMulti;

int suhu,kelembaban;

void setup() {

  Serial.begin(9600);
 //cek sensor MPU6050
  Serial.println("Menginisialisasi MPU6050");
  while(!mpu.begin(MPU6050_SCALE_2000DPS, MPU6050_RANGE_2G))
  {
    Serial.println("tidak ada sensor MPU6050 yang terpasang!");
//    delay(50);
  }
    
    USE_SERIAL.begin(115200);
   // USE_SERIAL.setDebugOutput(true);

    USE_SERIAL.println();
    USE_SERIAL.println();
    USE_SERIAL.println();

    for(uint8_t t = 4; t > 0; t--) {
        USE_SERIAL.printf("[SETUP] WAIT %d...\n", t);
        USE_SERIAL.flush();
//        delay(50);
    }

    WiFi.mode(WIFI_STA);
    WiFiMulti.addAP("ucok", "anjaylah123");

    // PANGGIL BUZZER,LED,SENSOR GETAR untuk input output
    pinMode(pinBuzzer, OUTPUT);
    pinMode(led, OUTPUT);
    pinMode(vs, INPUT);

}

void loop() {
  //SENSOR GETAR
  long measurement = vibration();
  delay(50);

  // jika data berupa logic HIGH atau 1
  if (measurement > 50)
  {
    // buzzer dan led menyala
    digitalWrite(led, HIGH);
    digitalWrite(pinBuzzer, HIGH);
  }


  // jika tidak
  else
  {
    // buzzer mati
    digitalWrite(pinBuzzer, LOW);
    digitalWrite(led, LOW);
  }

    ///KELEMBABAN TANAH
    int bacaSensor = analogRead(sensorPin);
    int kelembaban = map(bacaSensor,1023,0,0,100);
  
    //SUHU OUTPUT  (MPU6050)
        float celc = mpu.readTemperature();
        Serial.println("temperature ");
        Serial.print(celc);
        Serial.println(" *C");
  
    // wait for WiFi connection
    if((WiFiMulti.run() == WL_CONNECTED)) {

        HTTPClient http;
        
        USE_SERIAL.print("[HTTP] begin...\n");
        // configure traged server and url
        //http.begin("https://192.168.1.12/test.html", "7a 9c f4 db 40 d3 62 5a 6e 21 bc 5c cc 66 c8 3e a1 45 59 38"); //HTTPS
        http.begin("http://192.168.43.101/iot/data.php?getaran_tanah="+String(measurement)+"&kelembapan="+int(kelembaban)+"&suhu="+float(celc)); //HTTP

        USE_SERIAL.print("[HTTP] GET...\n");
        // start connection and send HTTP header
        int httpCode = http.GET();

        // httpCode will be negative on error
        if(httpCode > 0) {
            // HTTP header has been send and Server response header has been handled
            USE_SERIAL.printf("[HTTP] GET... code: %d\n", httpCode);

            // file found at server
            if(httpCode == HTTP_CODE_OK) {
                String payload = http.getString();
                USE_SERIAL.println(payload);
            }
        } else {
            USE_SERIAL.printf("[HTTP] GET... failed, error: %s\n", http.errorToString(httpCode).c_str());
        }

        http.end();
    }

//    delay(1000); 
}

long vibration(){
  long measurement=pulseIn (vs, HIGH);
  return measurement;
}
