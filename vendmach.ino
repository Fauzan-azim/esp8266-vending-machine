#include <ESP8266WiFi.h>
#include <ESP8266HTTPClient.h>

const char* ssid = "DIDI";
const char* pass = "sibungsuimron";
const char* host = "192.168.1.8";//server local 

const int item1 = D1; //GPIO5
const int trigPin = D6;
const int echoPin = D7;

#define timeSeconds 10
unsigned long now = millis();
unsigned long lastTrigger = 0;
boolean startTimer = false;

const int off = 1;
String responseRelay, postOFF;
WiFiClient client;
String Link, LinkBack, getBack;
HTTPClient http;

void wifiConn(){
//WIFI
   WiFi.mode(WIFI_OFF);        //Prevents reconnection issue (taking too long to connect)
   delay(1000);
   WiFi.mode(WIFI_STA); 
   //set wifi connection
   WiFi.hostname("NodeMCU");
   WiFi.begin(ssid, pass);

   //chechk wifi connection
   while(WiFi.status() != WL_CONNECTED){
     digitalWrite(LED_BUILTIN, HIGH);
     //reconnecting
     Serial.print(".");
     delay(500);
   }
   //WIFI CONNECTED
   Serial.println(" ");
   Serial.println("Connected to : " );
   Serial.print(" ");
   Serial.print(ssid);
   Serial.println(WiFi.localIP());
}

void setup() {
  // put your setup code here, to run once:
   Serial.begin(115200);
   pinMode(item1, OUTPUT);
   pinMode(trigPin, OUTPUT);
   pinMode(echoPin, INPUT);
   pinMode(LED_BUILTIN, OUTPUT); 
   digitalWrite(item1, HIGH);
   
   wifiConn();
}

void loop() {
  //checking process to server('computer')
   if(!client.connect(host, 80)){
    Serial.println("Connection failed");
    delay(1000);
    //return is reconnecting to server
    return;
  }
  //Serial.println("Connected to server"); 
  digitalWrite(LED_BUILTIN, LOW);
}
void orderItem1(){
  Link = "http://"+String(host)+"/vendMach_OTP/item1start.php";
  //link execution
  http.begin(client, Link);
  //GET requested data
  http.GET();
  String response = http.getString(); 
  Serial.println(response);
  http.end();
  
  //get quantity from php
  if(response == "2"){
    digitalWrite(item1 , response.toInt());
    delay(400);  
  }else if(response == "1"){
    digitalWrite(item1 , response.toInt());
    delay(200);
  }
  //stop relay after delay(millisec)
  getBack = String(response);
  postOFF = "status=" + getBack;
  LinkBack = "http://"+String(host)+"/vendMach_OTP/item1Stop.php";
  http.begin(client, LinkBack);
  http.addHeader("Content-Type", "application/x-www-form-urlencoded");
  int httpCode = http.POST(postOFF);
  String payload = http.getString();
  Serial.println(httpCode);
  Serial.println(payload);
  http.end();
}
int sensorVend(){
  long duration, distance;
  digitalWrite(trigPin, LOW);
  delayMicroseconds(2);
  digitalWrite(trigPin, HIGH);
  delayMicroseconds(10);
  digitalWrite(trigPin, LOW);
  duration = pulseIn(echoPin, HIGH);
  distance = (duration/2) / 29.1;
  return distance;
}
void sensorStart(){
  float sensorValue;
  startTimer = true;
  sensorValue = sensorVend();
  if(sensorValue && startTimer){
     now = millis();
    //Turn off the timer after the number of seconds defined in the timeSeconds variable
    orderItem1();
    lastTrigger = millis();
    startTimer = false;
    if(startTimer == false && (now - lastTrigger > (timeSeconds*3000))) {
      Serial.println("Coin inserted in this if rejected");
      startTimer = false;
      return;
    }
  }
  
}
