#include <ESP8266WiFi.h>
#include <Separador.h>
#include <WiFiClient.h> 
#include<SoftwareSerial.h>
SoftwareSerial SUART(4, 5); //SRX=Dpin-D2; STX-DPin-D1
//-------------------------
#include <SimpleDHT.h>
int temperature;
int humidity;
unsigned long previousMillis = 0;
String opcion= "manual";

int contconexion = 0;
const char *ssid = "dlink";
const char *password = "";
char host[48];
String strhost = "172.16.42.20";
String strurl = "/sensor";
String chipid = "";
Separador split;


//-------Función para Enviar Datos a la Base de Datos SQL--------
String enviardatos(String datos) {
  String linea = "error";
  WiFiClient client;
  strhost.toCharArray(host, 49);
  
  if (!client.connect(host, 80)) {
    Serial.println("Fallo de conexión…");
    return linea;
  }
client.print(String("POST ") + strurl + " HTTP/1.1" + "\r\n" + 
               "Host: " + strhost + "\r\n" +
               "Accept: */*" + "*\r\n" +
               "Content-Length: " + datos.length() + "\r\n" +
               "Content-Type: application/x-www-form-urlencoded" + "\r\n" +
               "\r\n" + datos);           
  delay(10);             
  
  Serial.print("Enviando datos a SQL...");
  
  unsigned long timeout = millis();
  while (client.available() == 0) {
    if (millis() - timeout > 5000) {
      Serial.println("Cliente fuera de tiempo!");
      client.stop();
      return linea;
    }
  }

  // Lee todas las líneas que recibe del servidor y las imprime por el terminal serial
  while(client.available()){
    linea = client.readStringUntil('\r');
  }  
  Serial.println(linea);
  return linea;
}

//----------------------------------------------------------------------------------------
void setup() {
  // Inicia Serial
  Serial.begin(115200); //enable Serial Monitor
  SUART.begin(115200); //enable SUART Port
  Serial.println(""); 

 // Conexión WIFI
  WiFi.begin(ssid, password);
  while (WiFi.status() != WL_CONNECTED and contconexion <50) { //Cuenta hasta 50 si no se puede conectar entonces cancela
    ++contconexion;
    delay(500);
    Serial.print(".");
  }
  if (contconexion <50) {
      //para usar con ip fija
      IPAddress ip(192,168,1,10); 
      IPAddress gateway(192,168,1,1); 
      IPAddress subnet(255,255,255,224); 
      WiFi.config(ip, gateway, subnet); 
      
      Serial.println("");
      Serial.println("Conexion establecida a: ");
      Serial.println(WiFi.localIP());
  }
  else { 
      Serial.println("");
      Serial.println("Error de conexion");
  }
}
      

void loop() { 
  String x = "";
  byte n = SUART.available(); //n != 0 means a character has arrived
  if (n > 0)
  {
     x = SUART.readString();  
    //read character
    //show character on Serial Monitor
  }
  unsigned long currentMillis = millis();

  if (currentMillis - previousMillis >= 1000) { //envia la temperatura cada 1 segundos
    //Serial.print(x);        
    previousMillis = currentMillis;
    
    enviardatos(x);
  }
}
        
 // }
