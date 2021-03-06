/*

  Ethernet shield attached to pins 10, 11, 12, 13

*/

/*
 Layout de pinos típico usado:
  -----------------------------------------------------------------------------------------
              MFRC522      Arduino       Arduino   Arduino    Arduino          Arduino
              Reader/PCD   Uno           Mega      Nano v3    Leonardo/Micro   Pro Micro
  Signal      Pin          Pin           Pin       Pin        Pin              Pin
  -----------------------------------------------------------------------------------------
  RST/Reset   RST          9             5         D9         RESET/ICSP-5     RST
  SPI SS      SDA(SS)      10            53        D10        10               10
  SPI MOSI    MOSI         11 / ICSP-4   51        D11        ICSP-4           16
  SPI MISO    MISO         12 / ICSP-1   50        D12        ICSP-1           14
  SPI SCK     SCK          13 / ICSP-3   52        D13        ICSP-3           15
*/
//------------------------------------------------------------------------------------------
#include <SPI.h>
#include <Ethernet.h>
#include <MFRC522.h>

//------------------------------------------------------------------------------------------
void make_request(String& id);                                     // Faça um pedido de crachá
//------------------------------------------------------------------------------------------
// CONFIG ethernet


byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFE, 0xED};
byte ip[] = {192, 198, 1, 12};  // IP da placa Arduino (shild eternet)
byte server[] = {XXX, XXX, XXX, XXX}; //IP do site

EthernetClient client;
//------------------------------------------------------------------------------------------
// CONFIG RFID
#define SS_PIN 9
#define RST_PIN 8
MFRC522 mfrc522(SS_PIN, RST_PIN);
//------------------------------------------------------------------------------------------

void setup()
{
  Serial.begin(9600);
  SPI.begin();
  mfrc522.PCD_Init();      // Init MFRC522

  // disable rfid
  pinMode(9, OUTPUT);
  digitalWrite(9, HIGH);

  // disable sd card
  pinMode(4, OUTPUT);
  digitalWrite(4, HIGH);

  // enable ethernet
  pinMode(10, OUTPUT);
  digitalWrite(10, LOW);

  pinMode(5, OUTPUT);
  pinMode(6, OUTPUT);
  pinMode(3, OUTPUT);
  digitalWrite(3, HIGH);
  // acquiring ip without dhcp
  Ethernet.begin(mac, ip);
  delay(1000);
}
//------------------------------------------------------------------------------------------
void loop()
{ // Se um cartão é lido, então obtenha o id do cartão e mande para make_request () para validação

  if ( ! mfrc522.PICC_IsNewCardPresent()) {
    return;
  }
  // Selecione um dos cartões
  if ( ! mfrc522.PICC_ReadCardSerial()) {
    return;
  }


  String id = "";
  for (byte i = 0; i < 4; i++) {
    id += String(mfrc522.uid.uidByte, HEX);
    //Serial.print(mfrc522.uid.uidByte, HEX);
  }
  Serial.println(id);
  delay(200);

  make_request(id);
}

void make_request(String& id)
{
  digitalWrite(6, LOW);
  digitalWrite(5, LOW);
  if (client.connect(server, 3306)) // porta do servidor Mysql
  {
    // crie a solicitação apontando para a página sob o caminho apache2 / htdocs / index.php
    String richiesta = "GET /dboard/ea/check_card.php?card_id=\"";
    richiesta += id;
    richiesta += "\" HTTP/1.0";
    client.println(richiesta);
    client.println();
    delay(50);
    Serial.print("conectado");
    String risposta = ""; // variável de resposta

    while (true)
    {
      if (client.available())
      {
        char ch = client.read();
        risposta += String(ch);
        //Serial.println(c);
      }
      // se não houver nada a ser lido a partir do servidor, a mensagem será exibida
      if (!client.connected())
      { client.stop();
        break;
      }
    }
    Serial.println(risposta);
    Serial.println(risposta.endsWith(" "));

    if (risposta.endsWith("OPEN")) {
      Serial.println("Ticket Purchased");
      digitalWrite(6, LOW);
      digitalWrite(3, LOW);
      digitalWrite(5, HIGH);
      status_sound();
      delay(500);
      digitalWrite(5, LOW);
      digitalWrite(3, HIGH);
    }

    if (risposta.endsWith("CLOSE")) {
      Serial.println("Ticket Close");
      digitalWrite(6, HIGH);
      digitalWrite(5, LOW);
      digitalWrite(3, LOW);
      status_sound();
      delay(500);
      status_sound();
      delay(500);
      digitalWrite(6, LOW);
      digitalWrite(3, HIGH);
    }
    delay(1000);
  }
}

void status_sound() {
  tone(7, 262, 200);
  tone(7, 196, 200);
  tone(7, 196, 200);
  tone(7, 220, 200);
  tone(7, 196, 200);
  tone(7, 247, 200);
  tone(7, 262, 200);
}
