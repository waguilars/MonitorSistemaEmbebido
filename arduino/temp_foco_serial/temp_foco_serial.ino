#include<SoftwareSerial.h>
SoftwareSerial SUART(4, 5); 
//-------------------------
#include <SimpleDHT.h>
// dht11
int pinDHT11 = 2;  //Humidity DATA line at A0-pin of UNO
SimpleDHT11 dht11;  //object is created from class
byte temperature = 0;
byte humidity = 0;
int control = 3 ;
int controll = 6;
int umbral = 21 ;
int menu = 1 ;
//foco
int foco = 13;
float h;
float t;
char modo;
//serial
void setup() {
 Serial.begin(115200); //enable Serial Monitor
  SUART.begin(115200); //enable SUART Port
  pinMode(foco, OUTPUT);
  pinMode(control,OUTPUT);
  digitalWrite(control, LOW); 
  pinMode(controll,OUTPUT);
  digitalWrite(controll, LOW); 
  digitalWrite(foco, LOW);   
}
void modo_automatico(){
    if ( temperature >= umbral){
            Serial.println("Modo automatico");
            Serial.print((int)temperature);
           digitalWrite(control, HIGH);
           digitalWrite(controll, HIGH);
           digitalWrite(foco,HIGH);        
           }
           else
           {
           digitalWrite(control, LOW);
           digitalWrite(controll, LOW);
           digitalWrite(foco,LOW);
           }     
  }

 // Codificacion
 // 1 ->Foco
 // 2 <- Ventilador  
 void modo_manual(){      
         digitalWrite(control, HIGH);
         digitalWrite(controll, HIGH);
         digitalWrite(foco,LOW); 
 }
void loop() {
      dht11.read(pinDHT11, &temperature, &humidity, NULL); 
     modo_automatico();      
      // modo_manual();  
     SUART.print("temp=");
     SUART.print((int)temperature);
     SUART.print('&');   
     SUART.print("hum=");            
     SUART.print((int)humidity);
     SUART.println();
     
  delay(1000);   
}

  
