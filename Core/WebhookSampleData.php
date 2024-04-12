<?php
    
namespace Hitek\Slimez\Payments\Core;

class WebhookSampleData{

    /*Mock data for testing webhook why developing */
    static $monnifyCardPayment = '{ 
        "transactionReference":"MNFY|20190920113413|000224",
        "paymentReference":"1568979249981",
        "amountPaid":"100.00",
        "totalPayable":"100.00",
        "settlementAmount" : "99.25", 
        "paidOn":"20/09/2019 11:35:21 AM",
        "paymentStatus":"PAID",
        "paymentDescription":"Is it working",
        "transactionHash":"5a91ef93b91a0bfda95a19c18da4504506ba20f79d6c0fb9ec3907b56635e7b01360e2a9ffcb5bc1e1208df68688a6d0ce064bec968099d7466818b6826cfd66",
        "currency":"NGN",
        "paymentMethod":"CARD",
        "product":{ 
           "type":"WEB_SDK",
           "reference":"1568979249981"
        },
        "cardDetails":{ 
           "cardType":null,
           "authorizationCode":null,
           "last4":"6871",
           "expMonth":"08",
           "expYear":"22",
           "bin":"539941",
           "reusable":false 	
        },
        "accountDetails": null,
        "accountPayments": null,
        "customer":{ 
           "email":"stephen@ikhane.com",
           "name":"Stephen Ikhane"
        }    "metaData" : { } 
     }';

    static $monnifyAccountTransfer = '{
        "transactionReference": "MNFY|20200900003149|000000",
        "paymentReference": "MNFY|20200900003149|000000",
        "amountPaid": "180000.00",
        "totalPayable": "180000.00",
        "settlementAmount": "179989.25",
        "paidOn": "09/09/2020 11:31:56 AM",
        "paymentStatus": "PAID",
        "paymentDescription": "Ojinaka Daniel",
        "transactionHash": "a294a0bfxxxxxxxxxxxxxxxxxxxx0b399cf077e30cf2ad54a7da9e17583deb5130286e6bb5dxxxx353f027725b83fcafac02d2e181f53edd5f",
        "currency": "NGN",
        "paymentMethod": "ACCOUNT_TRANSFER",
        "product": {
            "type": "RESERVED_ACCOUNT",
            "reference": "7b3xxxx072a44axxxxxxx2b6c2374458"
        },
        "cardDetails": null,
        "accountDetails": {
            "accountName": "John Ciroma Abuh",
            "accountNumber": "******4872",
            "bankCode": "000015",
            "amountPaid": "180000.00"
        },
        "accountPayments": [{
            "accountName": "John Ciroma Abuh",
            "accountNumber": "******4872",
            "bankCode": "000015",
            "amountPaid": "180000.00"
        }],
        "customer": {
            "email": "dojinaka@monnify.com",
            "name": "Daniel Ojinaka"
        },
        "metaData": {}
    }';

    static $monnifyPaymentReceived = '{
        "eventType": "SUCCESSFUL_TRANSACTION",
        "eventData": {
          "product": {
            "reference": "1636106097661",
            "type": "RESERVED_ACCOUNT"
          },
          "transactionReference": "MNFY|04|20211117112842|000170",
          "paymentReference": "MNFY|04|20211117112842|000170",
          "paidOn": "2021-11-17 11:28:42.615",
          "paymentDescription": "Adm",
          "metaData": {},
          "paymentSourceInformation": [
            {
              "bankCode": "",
              "amountPaid": 3000,
              "accountName": "Monnify Limited",
              "sessionId": "e6cV1smlpkwG38Cg6d5F9B2PRnIq5FqA",
              "accountNumber": "0065432190"
            }
          ],
          "destinationAccountInformation": {
            "bankCode": "232",
            "bankName": "Sterling bank",
            "accountNumber": "6000140770"
          },
          "amountPaid": 3000,
          "totalPayable": 3000,
          "cardDetails": {},
          "paymentMethod": "ACCOUNT_TRANSFER",
          "currency": "NGN",
          "settlementAmount": "2990.00",
          "paymentStatus": "PAID",
          "customer": {
            "name": "John Doe",
            "email": "test@tester.com"
          }
        }
      }';

      static $monnifyCardTransactionCompleted = '{
        "eventData": {
          "product": {
            "reference": "596048268",
            "type": "WEB_SDK"
          },
          "transactionReference": "MNFY|23|20211117124920|042042",
          "paymentReference": "596048268",
          "paidOn": "2021-11-17 12:50:19.269",
          "paymentDescription": "Pay With Monnify",
          "metaData": {
            "name": "Damilare",
            "age": "45"
          },
          "paymentSourceInformation": [],
          "destinationAccountInformation": {},
          "amountPaid": 100,
          "totalPayable": 100,
          "cardDetails": {
            "last4": "2718",
            "expMonth": "10",
            "expYear": "22",
            "bin": "506102",
            "reusable": false
          },
          "paymentMethod": "CARD",
          "currency": "NGN",
          "settlementAmount": "98.71",
          "paymentStatus": "PAID",
          "customer": {
            "name": "",
            "email": "ore2@monnify.com"
          }
        },
        "eventType": "SUCCESSFUL_TRANSACTION"
      }';

      static $monnifySuccessfulDisbursement = '{
        "eventType": "SUCCESSFUL_DISBURSEMENT",
        "eventData": {
          "amount": 10,
          "transactionReference": "MFDS|20210317032332|002431",
          "fee": 8,
          "transactionDescription": "Approved or completed successfully",
          "destinationAccountNumber": "0068687503",
          "sessionId": "090405210317032336726272971260",
          "createdOn": "17/03/2021 3:23:32 AM",
          "destinationAccountName": "DAMILARE SAMUEL OGUNNAIKE",
          "reference": "ref1615947809303",
          "destinationBankCode": "232",
          "completedOn": "17/03/2021 3:23:38 AM",
          "narration": "This is a quite long narration",
          "currency": "NGN",
          "destinationBankName": "Sterling bank",
          "status": "SUCCESS"
        }
      }';


      static $monnifyFailedDisbursement = '{
        "eventType": "FAILED_DISBURSEMENT",
        "eventData": {
          "amount": 1001,
          "transactionReference": "MFDS|20210317032705|002433",
          "fee": 8,
          "destinationAccountNumber": "0068687503",
          "sessionId": "",
          "createdOn": "17/03/2021 3:27:05 AM",
          "destinationAccountName": "DAMILARE SAMUEL OGUNNAIKE",
          "reference": "ref1615948022891",
          "destinationBankCode": "232",
          "completedOn": "17/03/2021 3:32:09 AM",
          "narration": "This is a quite long narration",
          "currency": "NGN",
          "destinationBankName": "Sterling bank",
          "status": "FAILED"
        }
      }';

      static $monnifyReversedDisbursement = '{
        "eventType" : "REVERSED_DISBURSEMENT",
        "eventData" : {
          "transactionReference" : "MFDS20210629125410AAAADP",
          "reference" : "ref1624967649578",
          "narration" : "911 Transaction",
          "currency" : "NGN",
          "amount" : 10.00,
          "status" : "REVERSED",
          "fee" : 1.00,
          "destinationAccountNumber" : "0700306714",
          "destinationAccountName" : "MEKILIUWA SMART CHINONSO",
          "destinationBankCode" : "101",
          "sessionId" : "ATL210629AABGPF",
          "createdOn" : "29/06/2021 12:54:10 PM",
          "completedOn" : "29/06/2021 12:54:12 PM"
        }
      }';


      static $monnifySuccessfulRefunds = '{
        "eventType": "SUCCESSFUL_REFUND",
        "eventData": {
          "merchantReason":"defective goods",
          "transactionReference":"MNFY|20190816083102|000021",
          "completedOn":"14/04/2021 4:24:05 PM",
          "refundStatus":"COMPLETED",
          "customerNote":"defects",
          "createdOn":"14/04/2021 4:23:37 PM",
          "refundReference":"ref001",
          "refundAmount":10:00
        }
      }';

      static $monnifyRefundFailed = '{
        "eventType": "FAILED_REFUND",
        "eventData": {
          "merchantReason":"defective goods",
          "transactionReference":"MNFY|20190816083102|000021",
          "completedOn":"14/04/2021 4:24:05 PM",
          "refundStatus":"FAILED",
          "customerNote":"defects",
          "createdOn":"14/04/2021 4:23:37 PM",
          "refundReference":"ref001",
          "refundAmount":10:00
        }
      }';

      static $monnifySettlement = '{
        "eventData": {
          "amount": "1199.00",
          "settlementTime": "11/11/2021 02:29:00 PM",
          "settlementReference": "LB8HG1PNZT4ATJGZXQBY",
          "destinationAccountNumber": "6000000249",
          "destinationBankName": "Fidelity Bank",
          "destinationAccountName": "Teamapt Limited234",
          "transactionsCount": 1,
          "transactions": [
            {
              "product": {
                "reference": "2134565wda",
                "type": "2134565wda"
              },
              "transactionReference": "MNFY|26|20211111142601|000001",
              "paymentReference": "MNFY|26|20211111142601|000001",
              "paidOn": "11/11/2021 02:26:02 PM",
              "paymentDescription": "Seg",
              "accountPayments": [
                {
                  "bankCode": "000014",
                  "amountPaid": "1234.00",
                  "accountName": "Okeke Chimezie",
                  "accountNumber": "******1070"
                }
              ],
              "amountPaid": "1234.00",
              "totalPayable": "1234.00",
              "accountDetails": {
                "bankCode": "000014",
                "amountPaid": "1234.00",
                "accountName": "Okeke Chimezie",
                "accountNumber": "******1070"
              },
              "cardDetails": {},
              "paymentMethod": "ACCOUNT_TRANSFER",
              "currency": "NGN",
              "paymentStatus": "PAID",
              "customer": {
                "name": "Segun Adeponle",
                "email": "segunadeponle@gmail.com"
              }
            }
          ]
        },
        "eventType": "SETTLEMENT"
      }';

      static $monnifyOfflinePayment = '{
        "eventData": {
          "product": {
            "reference": "MNF-Tl9Noo0G48000890",
            "type": "OFFLINE_PAYMENT_AGENT"
          },
          "transactionReference": "MNFY|76|20230830171357|000252",
          "invoiceReference": "MNF-Tl9Noo0G48000890",
          "paymentReference": "MNF-Tl9Noo0G48000890",
          "paidOn": "30/08/2023 5:13:57 PM",
          "paymentDescription": "adron",
          "metaData":{
            "phoneNumber":"08088523241",
            "name":"Khalid"
          },
          "destinationAccountInformation": {},
          "paymentSourceInformation": {},
          "amountPaid": 15000,
          "totalPayable": 15000,
          "offlineProductInformation": {
            "amount": 15000,
            "code": "56417",
            "type": "INVOICE"
          },
          "cardDetails": {},
          "paymentMethod": "CASH",
          "currency": "NGN",
          "settlementAmount": 14990,
          "paymentStatus": "PAID",
          "customer": {
            "name": "David Customer",
            "email": "mayluv55@hotmail.co.uk"
          }
        },
        "eventType": "SUCCESSFUL_TRANSACTION"
      }';

      static $monnifyRejectionPayment = '{
        "eventData": {
          "metaData": "{"name":"Marvelous","age":"90"}",
          "product": {
            "reference": "MNFY|PAYREF|GENERATED|1687798434397393735",
            "type": "WEB_SDK"
          },
          "amount": 100,
          "paymentSourceInformation": {
            "bankCode": "50515",
            "amountPaid": 40,
            "accountName": "MARVELOUS BENJI",
            "sessionId": "090405230626180003067844645188",
            "accountNumber": "5141901487"
          },
          "transactionReference": "MNFY|85|20230626175354|041855",
          "created_on": "2023-06-26 17:53:55.0",
          "paymentReference": "MNFY|PAYREF|GENERATED|1687798434397393735",
          "paymentRejectionInformation": {
            "bankCode": "035",
            "destinationAccountNumber": "7023576853",
            "bankName": "Wema bank",
            "rejectionReason": "UNDER_PAYMENT",
            "expectedAmount": 100
          },
          "paymentDescription": "lets pay",
          "customer": {
            "name": "Marvelous Benji",
            "email": "benji71@gmail.com"
          }
        },
        "eventType": "REJECTED_PAYMENT"
      }';

    /**
     * seerbit webhook sample data
     * just to test the developemnt
     */

    static $seerbitRefundEvent = '{
            "notificationItems": [
                {
                    "notificationRequestItem": {
                        "eventType": "refund",
                        "eventDate": "2020-05-01 12:55:57",
                        "eventId": "0be677f841254a3eb92fab0d0b6ba232",
                        "data": {
                            "amount": "10",
                            "createdAt": "2019-10-24 07:47:49",
                            "transactionRef": "IHrE1571828556059",
                            "description": "I need my money",
                            "type": "FULL_REFUND",
                            "mode": "TEST",
                            "updatedAt": "2019-10-24 07:47:49"
                        }
                    }
                }
            ]
        }';

    static $seerbitDisputeEvent = '{
                "notificationItems": [
                    {
                    "notificationRequestItem": {
                            "eventType": "dispute",
                            "eventDate": "2020-05-01 12:56:07",
                            "eventId": "da28df9ea5dd4807b59e5761afd7231b",
                            "data": {
                                "evidence": [
                                    {
                                    "images": [
                                        {
                                            "image": ""
                                        }
                                        ],
                                    }
                                ]
                            },
                        }
                    }
                ]
            }';

        static $seerbitTransactionEvent = '{
                "notificationItems": [
                   {
                      "notificationRequestItem": {
                         "eventType": "transaction",
                         "eventDate": "2020-05-01 12:56:22",
                         "eventId": "d95b17db00984ef6847913eb5f35c97d",
                         "data": {
                            "amount": "2.00",
                            "mobile": "08039229321",
                            "status": "APPROVED",
                            "reference": "54637776z",
                            "gatewayMessage": "Approved by financial institution",
                            "publicKey": "tNUFstIHrE",
                            "businessName": "Centric Gateway",
                            "accountNumber": "0011929382",
                            "bankCode": "000016",
                            "description": "transaction event occurred",
                            "fee": "2.00",
                            "clientAppCode": "app1",
                            "datetime": "2019:11:22 01:45:24",
                            "callbackUrl": "https://checkout.seerbit.com/?m=EQREZEhyRn",
                            "redirectUrl": "https://checkout.seerbit.com/?m=EQREZEhyRn",
                            "channel": "transfer",
                            "productId": "Foods",
                            "channelType": "Mastercard",
                            "maskedPan": "4508-75xx-xxxx-1019",
                            "sourceIP": "1.0.0.10",
                            "deviceType": "Apple Laptop",
                            "type": "3DSECURE",
                            "fullname": "John Doe",
                            "email": "paulossp32@gmail.com",
                            "gatewayReference": "",
                            "grossAmount": "3.00",
                            "country": "NG",
                            "currency": "NGN",
                            "creditAccountName": "Centric Gateway",
                            "creditAccountNumber": "1212321211",
                            "narration": "My narration here",
                            "sessionId": "00002999299388837772828883778",
                            "bankName": "firstbank",
                            "externalReference": "2i2idde2",
                            "createdAt": "2019:11:22 01:45:24",
                            "updatedAt": "2019:11:22 01:45:24",
                            "generatedAt": "2019:11:22 01:45:24",
                            "lastFourDigits": "007",
                            "cardBin": "222300",
                            "paymentType": "CARD"
                         }
                      }
                   }
                ]
             }';

        static $seerbitWalletEvent = '{
            "notificationItems": [
               {
                  "notificationRequestItem": {
                     "eventType": "transaction.wallet",
                     "eventDate": "2020-05-01 12:52:28",
                     "eventId": "c472deceabf44924901b104523af14df",
                     "data": {
                        "amount": "100.00",
                        "mobile": "08033456500",
                        "reference": "shh3332hwhwhh22hjjjwj",
                        "gatewayMessage": "APPROVED",
                        "publicKey": "hhw33y2x",
                        "bankCode": "000016",
                        "description": "wallet transaction",
                        "fee": "2.00",
                        "type": "Transfer",
                        "fullname": "John Doe",
                        "email": "peter.diei@centricgateway.com",
                        "country": "NG",
                        "currency": "NGN",
                        "origin": "string",
                        "internalRef": "string",
                        "creditAccountName": "Test Account",
                        "creditAccountNumber": "23221122321",
                        "originatorAccountnumber": "1929383828392",
                        "originatorName": "CGW",
                        "narration": "my narration here",
                        "sessionId": "00002999299388837772828883778",
                        "externalReference": "2203000002992910219",
                        "createdAt": "2019-12-12 16:20:59",
                        "updatedAt": "2019-12-12 16:20:59"
                     }
                  }
               }
            ]
         }';
        
        static $seerbitRecurringPaymentEvent = '{
            "notificationItems": [
               {
                  "notificationRequestItem": {
                     "eventType": "transaction.recurrent",
                     "eventDate": "2020-05-01 12:50:33",
                     "eventId": "30a33df05b0c465c8c38f4113621685a",
                     "data": {
                        "amount": "150",
                        "mobile": "08033456500",
                        "reference": "TESTPilotR251218123PPOIU149",
                        "publicKey": "SBTESTPUBK_dhrpzbRpR34l6VmqkCFOKA94L5E1jSTu",
                        "description": "Pilot Test Subscription",
                        "productId": "Terrain",
                        "maskedPan": "5123-45xx-xxxx-0008",
                        "email": "akintoyekolawole@gmail.com",
                        "gatewayReference": "F325090871582705056234",
                        "country": "NG",
                        "narration": "Reccurrent",
                        "createdAt": "2020-02-26T09:17:30",
                        "updatedAt": "2020-02-26T09:18:26.496",
                        "lastFourDigits": "0008",
                        "cardBin": "512345"
                     }
                  }
               }
            ]
         }';
        
        static $seerbitRecurringDebitEvent = '{
            "notificationItems": [
               {
                  "notificationRequestItem": {
                     "eventType": "transaction.recurring.debit",
                     "eventDate": "2020-05-01 12:55:32",
                     "eventId": "799f8cad23bc4bc389280f996d81ea55",
                     "data": {
                        "amount": "2000",
                        "reference": "PILOT76558370651618723659",
                        "gatewayMessage": "Successful",
                        "publicKey": "SBTESTPUBK_dhrpzbRpR34l6VmqkCFOKA94L5E1jSTu",
                        "description": "Authorised charge",
                        "channelType": "Recurring Debit",
                        "maskedPan": "5123--4xx-xxxx-xx-0",
                        "type": "TOKEN",
                        "fullname": "Frank Gboyega",
                        "email": "gboyega@fcmb.com",
                        "gatewayReference": "F786046901582644089560",
                        "country": "NG",
                        "currency": "NGN",
                        "narration": "Authorised charge",
                        "createdAt": "2020-02-25T16:21:23",
                        "updatedAt": "2020-02-25T16:21:31.319",
                        "paymentType": "card"
                     }
                  }
               }
            ]
         }';

    static $seerbitVirtualAccountEvent = '{
            "notificationItems": [
              {
                "notificationRequestItem": {
                  "eventType": "transaction",
                  "eventDate": "2023-10-06 12:56:47",
                  "eventId": "88bf9852405143bd99502c378b316fdd",
                  "data": {
                    "amount": 100,
                    "country": "NG",
                    "creditAccountName": "BusinessName(Customer Name)",
                    "creditAccountNumber": "4018013418",
                    "currency": "NGN",
                    "email": "xyx@email.com",
                    "externalReference": "GT-012",
                    "fullname": "Adamu Bola Ciroma",
                    "gatewayCode": "00",
                    "code": "00",
                    "internalRef": "",
                    "gatewayMessage": "Successful",
                    "mobile": "404",
                    "narration": "",
                    "origin": "",
                    "originatorAccountnumber": "<Account Number>",
                    "originatorName": "<Account Name>",
                    "publicKey": "<PublicKey>",
                    "reference": "GT-012_SBT_9ADPCIV269",
                    "reason": "Successful"
                  }
                }
              }
            ]
          }';


    
    
          /*reloadly data topup response */
    
    
    
    
    
          static $reloadlyLocalDataTopup = '[
        {
          "id": 1109,
          "operatorId": 1109,
          "name": "Airtel-Tigo Ghana Data ",
          "bundle": false,
          "data": true,
          "pin": false,
          "supportsLocalAmounts": true,
          "supportsGeographicalRechargePlans": false,
          "denominationType": "FIXED",
          "senderCurrencyCode": "NGN",
          "senderCurrencySymbol": "?",
          "destinationCurrencyCode": "GHS",
          "destinationCurrencySymbol": "GH?",
          "commission": 0,
          "internationalDiscount": 0,
          "localDiscount": 0,
          "mostPopularAmount": 5200.25,
          "mostPopularLocalAmount": 50,
          "minAmount": null,
          "maxAmount": null,
          "localMinAmount": null,
          "localMaxAmount": null,
          "country": {
            "isoName": "GH",
            "name": "Ghana"
          },
          "fx": {
            "rate": 0.0096,
            "currencyCode": "GHS"
          },
          "logoUrls": [
            "https://s3.amazonaws.com/rld-portal-avatar-prd/0c0d0d6c-2e48-499d-ab2e-87c6c7709f3e.png",
            "https://s3.amazonaws.com/rld-portal-avatar-prd/475e3687-5361-49c8-9143-9e91978eeeb4.png",
            "https://s3.amazonaws.com/rld-portal-avatar-prd/99b60abb-f35b-4bf4-8810-02bf9f8fc6c2.png"
          ],
          "fixedAmounts": [
            312.02,
            520.03,
            532.51,
            624.03,
            1040.05,
            1560.08,
            2080.1,
            5200.25
          ],
          "fixedAmountsDescriptions": {
            "312.02": "1GB Plan Mobile Data",
            "520.03": "1.1GB Mobile Data",
            "532.51": "625MB Mobile Data",
            "624.03": "2GB Plan Mobile Data\t",
            "1040.05": "1.75GB Mobile Data\t",
            "1560.08": "5.5GB Plan Mobile Data",
            "2080.10": "4.65GB Mobile Data\t",
            "5200.25": "11GB Mobile Data"
          },
          "localFixedAmounts": [
            3,
            5,
            5.13,
            6,
            10,
            15,
            20,
            50
          ],
          "localFixedAmountsDescriptions": {
            "3.00": "1GB Plan Mobile Data",
            "5.00": "1.1GB Mobile Data",
            "5.13": "625MB Mobile Data",
            "6.00": "2GB Plan Mobile Data\t",
            "10.00": "1.75GB Mobile Data\t",
            "15.00": "5.5GB Plan Mobile Data",
            "20.00": "4.65GB Mobile Data\t",
            "50.00": "11GB Mobile Data"
          },
          "suggestedAmounts": [],
          "suggestedAmountsMap": {},
          "geographicalRechargePlans": [],
          "promotions": [],
          "status": "ACTIVE"
        },
        {
          "id": 642,
          "operatorId": 642,
          "name": "Glo Ghana Data",
          "bundle": false,
          "data": true,
          "pin": false,
          "supportsLocalAmounts": true,
          "supportsGeographicalRechargePlans": false,
          "denominationType": "FIXED",
          "senderCurrencyCode": "NGN",
          "senderCurrencySymbol": "?",
          "destinationCurrencyCode": "GHS",
          "destinationCurrencySymbol": "GH?",
          "commission": 0,
          "internationalDiscount": 0,
          "localDiscount": 0,
          "mostPopularAmount": 24961.2,
          "mostPopularLocalAmount": 300,
          "minAmount": null,
          "maxAmount": null,
          "localMinAmount": null,
          "localMaxAmount": null,
          "country": {
            "isoName": "GH",
            "name": "Ghana"
          },
          "fx": {
            "rate": 0.012,
            "currencyCode": "GHS"
          },
          "logoUrls": [
            "https://s3.amazonaws.com/rld-operator/607ef89f-9f39-47fe-abfd-4977aa8b60b3-size-1.png",
            "https://s3.amazonaws.com/rld-operator/607ef89f-9f39-47fe-abfd-4977aa8b60b3-size-3.png",
            "https://s3.amazonaws.com/rld-operator/607ef89f-9f39-47fe-abfd-4977aa8b60b3-size-2.png"
          ],
          "fixedAmounts": [
            83.2,
            166.41,
            416.02,
            832.04,
            1664.08,
            3328.16,
            4160.2,
            4992.24,
            6656.32,
            8320.4,
            12480.6,
            24961.2
          ],
          "fixedAmountsDescriptions": {
            "83.20": "300MB Plan, Validity 2days.",
            "166.41": "600MB Plan, Validity 4days.",
            "416.02": "1.5GB Plan, Validity 10days.",
            "832.04": "4GB Plan, Validity 7days.",
            "1664.08": "4.2GB Plan, Validity 30days.",
            "3328.16": "10GB, Validity 30days.",
            "4160.20": "15GB Plan, Validity 30days.",
            "4992.24": "20GB, Validity 30days.",
            "6656.32": "30GB Plan, Validity 60days.",
            "8320.40": "60GB, Validity 90days.",
            "12480.60": "100GB, Validity 90days.",
            "24961.20": "UNLIMITED Data, Validity 30days."
          },
          "localFixedAmounts": [
            1,
            2,
            5,
            10,
            20,
            40,
            50,
            60,
            80,
            100,
            150,
            300
          ],
          "localFixedAmountsDescriptions": {
            "1.00": "300MB Plan, Validity 2days.",
            "2.00": "600MB Plan, Validity 4days.",
            "5.00": "1.5GB Plan, Validity 10days.",
            "10.00": "4GB Plan, Validity 7days.",
            "20.00": "4.2GB Plan, Validity 30days.",
            "40.00": "10GB, Validity 30days.",
            "50.00": "15GB Plan, Validity 30days.",
            "60.00": "20GB, Validity 30days.",
            "80.00": "30GB Plan, Validity 60days.",
            "100.00": "60GB, Validity 90days.",
            "150.00": "100GB, Validity 90days.",
            "300.00": "UNLIMITED Data, Validity 30days."
          },
          "suggestedAmounts": [],
          "suggestedAmountsMap": {},
          "geographicalRechargePlans": [],
          "promotions": [],
          "status": "ACTIVE"
        },
        {
          "id": 643,
          "operatorId": 643,
          "name": "MTN Ghana Data",
          "bundle": false,
          "data": true,
          "pin": false,
          "supportsLocalAmounts": true,
          "supportsGeographicalRechargePlans": false,
          "denominationType": "FIXED",
          "senderCurrencyCode": "NGN",
          "senderCurrencySymbol": "?",
          "destinationCurrencyCode": "GHS",
          "destinationCurrencySymbol": "GH?",
          "commission": 0,
          "internationalDiscount": 0,
          "localDiscount": 0,
          "mostPopularAmount": 4160.2,
          "mostPopularLocalAmount": 50,
          "minAmount": null,
          "maxAmount": null,
          "localMinAmount": null,
          "localMaxAmount": null,
          "country": {
            "isoName": "GH",
            "name": "Ghana"
          },
          "fx": {
            "rate": 0.012,
            "currencyCode": "GHS"
          },
          "logoUrls": [
            "https://s3.amazonaws.com/rld-operator/47fdee6a-c4a1-41c0-963e-843cae07b0c9-size-3.png",
            "https://s3.amazonaws.com/rld-operator/47fdee6a-c4a1-41c0-963e-843cae07b0c9-size-1.png",
            "https://s3.amazonaws.com/rld-operator/47fdee6a-c4a1-41c0-963e-843cae07b0c9-size-2.png"
          ],
          "fixedAmounts": [
            41.6,
            83.2,
            249.61,
            416.02,
            832.04,
            1664.08,
            2496.12,
            3328.16,
            4160.2
          ],
          "fixedAmountsDescriptions": {
            "41.60": "24.05MB Mobile Data",
            "83.20": "96.15MB Social Media Mobile Data",
            "249.61": "471.70MB Mobile Data Bundle",
            "416.02": "917.43MB Video Bundle Mobile Data",
            "832.04": "1.79GB Video Mobile Data1",
            "1664.08": "2000MB Monthly Video Mobile Data\t",
            "2496.12": "3500MB Monthly Video Mobile Data\t",
            "3328.16": "5000MB Monthly Video Mobile Data\t",
            "4160.20": "7000MB Monthly Video Mobile Data\t"
          },
          "localFixedAmounts": [
            0.5,
            1,
            3,
            5,
            10,
            20,
            30,
            40,
            50
          ],
          "localFixedAmountsDescriptions": {
            "0.50": "24.05MB Mobile Data",
            "1.00": "96.15MB Social Media Mobile Data",
            "3.00": "471.70MB Mobile Data Bundle",
            "5.00": "917.43MB Video Bundle Mobile Data",
            "10.00": "1.79GB Video Mobile Data1",
            "20.00": "2000MB Monthly Video Mobile Data\t",
            "30.00": "3500MB Monthly Video Mobile Data\t",
            "40.00": "5000MB Monthly Video Mobile Data\t",
            "50.00": "7000MB Monthly Video Mobile Data\t"
          },
          "suggestedAmounts": [],
          "suggestedAmountsMap": {},
          "geographicalRechargePlans": [],
          "promotions": [],
          "status": "ACTIVE"
        },
        {
          "id": 771,
          "operatorId": 771,
          "name": "Surfline Ghana Data",
          "bundle": false,
          "data": true,
          "pin": false,
          "supportsLocalAmounts": true,
          "supportsGeographicalRechargePlans": false,
          "denominationType": "FIXED",
          "senderCurrencyCode": "NGN",
          "senderCurrencySymbol": "?",
          "destinationCurrencyCode": "GHS",
          "destinationCurrencySymbol": "GH?",
          "commission": 0,
          "internationalDiscount": 0,
          "localDiscount": 0,
          "mostPopularAmount": 49839.2,
          "mostPopularLocalAmount": 799,
          "minAmount": null,
          "maxAmount": null,
          "localMinAmount": null,
          "localMaxAmount": null,
          "country": {
            "isoName": "GH",
            "name": "Ghana"
          },
          "fx": {
            "rate": 0.012,
            "currencyCode": "GHS"
          },
          "logoUrls": [
            "https://s3.amazonaws.com/rld-operator/033167db-663e-4ca9-8934-183ac220fd95-size-3.png",
            "https://s3.amazonaws.com/rld-operator/033167db-663e-4ca9-8934-183ac220fd95-size-2.png",
            "https://s3.amazonaws.com/rld-operator/033167db-663e-4ca9-8934-183ac220fd95-size-1.png"
          ],
          "fixedAmounts": [
            832.04,
            1664.08,
            2912.14,
            3328.16,
            5824.28,
            8320.4,
            9152.44,
            15392.74,
            21217.02,
            27041.3,
            29953.44,
            33198.4,
            34113.64,
            49839.2,
            66480
          ],
          "fixedAmountsDescriptions": {
            "832.04": "1.5GB 24Hrs",
            "1664.08": "3GB 3days",
            "2912.14": "4.5GB 7days",
            "3328.16": "6GB 30days",
            "5824.28": "8GB 30days",
            "8320.40": "15GB 30days",
            "9152.44": "Unlimited Night 30days",
            "15392.74": "30GB 30days",
            "21217.02": "45GB 30days",
            "27041.30": "75GB 45days",
            "29953.44": "Unlimited 30days",
            "33198.40": "Standard Unlimited 30days",
            "34113.64": "100GB 60days",
            "49839.20": "Super Unlimited 30days",
            "66480.00": "Ultra Unlimited 30days"
          },
          "localFixedAmounts": [
            10,
            20,
            35,
            40,
            70,
            100,
            110,
            185,
            255,
            325,
            360,
            399,
            410,
            599,
            799
          ],
          "localFixedAmountsDescriptions": {
            "10.00": "1.5GB 24Hrs",
            "20.00": "3GB 3days",
            "35.00": "4.5GB 7days",
            "40.00": "6GB 30days",
            "70.00": "8GB 30days",
            "100.00": "15GB 30days",
            "110.00": "Unlimited Night 30days",
            "185.00": "30GB 30days",
            "255.00": "45GB 30days",
            "325.00": "75GB 45days",
            "360.00": "Unlimited 30days",
            "399.00": "Standard Unlimited 30days",
            "410.00": "100GB 60days",
            "599.00": "Super Unlimited 30days",
            "799.00": "Ultra Unlimited 30days"
          },
          "suggestedAmounts": [],
          "suggestedAmountsMap": {},
          "geographicalRechargePlans": [],
          "promotions": [],
          "status": "ACTIVE"
        },
        {
          "id": 770,
          "operatorId": 770,
          "name": "Vodafone Ghana Data",
          "bundle": false,
          "data": true,
          "pin": false,
          "supportsLocalAmounts": true,
          "supportsGeographicalRechargePlans": false,
          "denominationType": "FIXED",
          "senderCurrencyCode": "NGN",
          "senderCurrencySymbol": "?",
          "destinationCurrencyCode": "GHS",
          "destinationCurrencySymbol": "GH?",
          "commission": 0,
          "internationalDiscount": 0,
          "localDiscount": 0,
          "mostPopularAmount": 4493.02,
          "mostPopularLocalAmount": 54,
          "minAmount": null,
          "maxAmount": null,
          "localMinAmount": null,
          "localMaxAmount": null,
          "country": {
            "isoName": "GH",
            "name": "Ghana"
          },
          "fx": {
            "rate": 0.012,
            "currencyCode": "GHS"
          },
          "logoUrls": [
            "https://s3.amazonaws.com/rld-operator/9d8ea314-790c-4ba8-8220-8277fc6ead3c-size-3.png",
            "https://s3.amazonaws.com/rld-operator/9d8ea314-790c-4ba8-8220-8277fc6ead3c-size-2.png",
            "https://s3.amazonaws.com/rld-operator/9d8ea314-790c-4ba8-8220-8277fc6ead3c-size-1.png"
          ],
          "fixedAmounts": [
            166.41,
            894.44,
            4493.02
          ],
          "fixedAmountsDescriptions": {
            "166.41": "Volume 122MB, BrowserDaily, Validity 3days.",
            "894.44": "Volume 563MB, StarterMonthly, Validity 37days.",
            "4493.02": "Volume 5767MB, StreamerWeekly, Validity 10days."
          },
          "localFixedAmounts": [
            2,
            10.75,
            54
          ],
          "localFixedAmountsDescriptions": {
            "2.00": "Volume 122MB, BrowserDaily, Validity 3days.",
            "10.75": "Volume 563MB, StarterMonthly, Validity 37days.",
            "54.00": "Volume 5767MB, StreamerWeekly, Validity 10days."
          },
          "suggestedAmounts": [],
          "suggestedAmountsMap": {},
          "geographicalRechargePlans": [],
          "promotions": [],
          "status": "ACTIVE"
        }
      ]';

      static $reloadlyInternationalDataTopup = '{
        "transactionId": 34953,
        "status": "SUCCESSFUL",
        "operatorTransactionId": null,
        "customIdentifier": "mtn-ghana-data-topup",
        "recipientPhone": "233540903921",
        "recipientEmail": "anyone@email.com",
        "senderPhone": "1231231231",
        "countryCode": "GH",
        "operatorId": 643,
        "operatorName": "MTN Ghana Data",
        "discount": 0,
        "discountCurrencyCode": "NGN",
        "requestedAmount": 4160,
        "requestedAmountCurrencyCode": "NGN",
        "deliveredAmount": 50,
        "deliveredAmountCurrencyCode": "GHS",
        "transactionDate": "2022-06-23 13:23:50",
        "pinDetail": null,
        "balanceInfo": {
          "oldBalance": 809964.36995,
          "newBalance": 805804.36995,
          "cost": 4160,
          "currencyCode": "NGN",
          "currencyName": "Nigerian Naira",
          "updatedAt": "2022-06-23 17:23:50"
        }
      }';

     /**
     * paystack webhook sample data
     * just to test the developemnt
     */

    static $payStackFailedCustomeridentification = '{

        "event": "customeridentification.failed",
      
        "data": {
      
          "customer_id": 82796315,
      
          "customer_code": "CUS_XXXXXXXXXXXXXXX",
      
          "email": "email@email.com",
      
          "identification": {
      
            "country": "NG",
      
            "type": "bank_account",
      
            "bvn": "123*****456",
      
            "account_number": "012****345",
      
            "bank_code": "999991"
      
          },
      
          "reason": "Account number or BVN is incorrect"
      
        }
      
      }';

      static $payStackSuccessCustomeridentification = '{

        "event": "customeridentification.success",
      
        "data": {
      
          "customer_id": "9387490384",
      
          "customer_code": "CUS_xnxdt6s1zg1f4nx",
      
          "email": "bojack@horsinaround.com",
      
          "identification": {
      
            "country": "NG",
      
            "type": "bvn",
      
            "value": "200*****677"
      
          }
      
        }
      
      }';

      static $payStackChargeDisputeCreate = '{

        "event": "charge.dispute.create",
      
        "data": {
      
          "id": 358950,
      
          "refund_amount": 5800,
      
          "currency": "NGN",
      
          "status": "awaiting-merchant-feedback",
      
          "resolution": null,
      
          "domain": "live",
      
          "transaction": {
      
            "id": 896467688,
      
            "domain": "live",
      
            "status": "success",
      
            "reference": "v3mjfgbnc19v97x",
      
            "amount": 5800,
      
            "message": null,
      
            "gateway_response": "Approved",
      
            "paid_at": "2020-11-24T13:45:57.000Z",
      
            "created_at": "2020-11-24T13:45:57.000Z",
      
            "channel": "card",
      
            "currency": "NGN",
      
            "ip_address": null,
      
            "metadata": "",
      
            "log": null,
      
            "fees": 53,
      
            "fees_split": null,
      
            "authorization": {},
      
            "customer": {
      
              "international_format_phone": null
      
            },
      
            "plan": {},
      
            "subaccount": {},
      
            "split": {},
      
            "order_id": null,
      
            "paidAt": "2020-11-24T13:45:57.000Z",
      
            "requested_amount": 5800,
      
            "pos_transaction_data": null
      
          },
      
          "transaction_reference": null,
      
          "category": "chargeback",
      
          "customer": {
      
            "id": 5406463,
      
            "first_name": "John",
      
            "last_name": "Doe",
      
            "email": "example@test.com",
      
            "customer_code": "CUS_6wbxh6689vt0n7s",
      
            "phone": "08000000000",
      
            "metadata": {},
      
            "risk_action": "allow",
      
            "international_format_phone": null
      
          },
      
          "bin": "123456",
      
          "last4": "1234",
      
          "dueAt": "2020-11-25T18:00:00.000Z",
      
          "resolvedAt": null,
      
          "evidence": null,
      
          "attachments": null,
      
          "note": null,
      
          "history": [
      
            {
      
              "status": "pending",
      
              "by": "example@test.com",
      
              "createdAt": "2020-11-24T13:46:57.000Z"
      
            }
      
          ],
      
          "messages": [
      
            {
      
              "sender": "example@test.com",
      
              "body": "Customer complained about debit without value",
      
              "createdAt": "2020-11-24T13:46:57.000Z"
      
            }
      
          ],
      
          "created_at": "2020-11-24T13:46:57.000Z",
      
          "updated_at": "2020-11-24T18:00:02.000Z"
      
        }
      
      }';

      static $payStackChargeDisputeReminder = '{

        "event": "charge.dispute.remind",
      
        "data": {
      
          "id": 358950,
      
          "refund_amount": 5800,
      
          "currency": "NGN",
      
          "status": "awaiting-merchant-feedback",
      
          "resolution": null,
      
          "domain": "live",
      
          "transaction": {
      
            "id": 896467688,
      
            "domain": "live",
      
            "status": "success",
      
            "reference": "v3mjfgbnc19v97x",
      
            "amount": 5800,
      
            "message": null,
      
            "gateway_response": "Approved",
      
            "paid_at": "2020-11-24T13:45:57.000Z",
      
            "created_at": "2020-11-24T13:45:57.000Z",
      
            "channel": "card",
      
            "currency": "NGN",
      
            "ip_address": null,
      
            "metadata": "",
      
            "log": null,
      
            "fees": 53,
      
            "fees_split": null,
      
            "authorization": {},
      
            "customer": {
      
              "international_format_phone": null
      
            },
      
            "plan": {},
      
            "subaccount": {},
      
            "split": {},
      
            "order_id": null,
      
            "paidAt": "2020-11-24T13:45:57.000Z",
      
            "requested_amount": 5800,
      
            "pos_transaction_data": null
      
          },
      
          "transaction_reference": null,
      
          "category": "chargeback",
      
          "customer": {
      
            "id": 5406463,
      
            "first_name": "John",
      
            "last_name": "Doe",
      
            "email": "example@test.com",
      
            "customer_code": "CUS_6wbxh6689vt0n7s",
      
            "phone": "08000000000",
      
            "metadata": {},
      
            "risk_action": "allow",
      
            "international_format_phone": null
      
          },
      
          "bin": "123456",
      
          "last4": "1234",
      
          "dueAt": "2020-11-25T18:00:00.000Z",
      
          "resolvedAt": null,
      
          "evidence": null,
      
          "attachments": null,
      
          "note": null,
      
          "history": [
      
            {
      
              "status": "pending",
      
              "by": "example@test.com",
      
              "createdAt": "2020-11-24T13:46:57.000Z"
      
            }
      
          ],
      
          "messages": [
      
            {
      
              "sender": "example@test.com",
      
              "body": "Customer complained about debit without value",
      
              "createdAt": "2020-11-24T13:46:57.000Z"
      
            }
      
          ],
      
          "created_at": "2020-11-24T13:46:57.000Z",
      
          "updated_at": "2020-11-24T18:00:02.000Z"
      
        }
      
      }';

      static $payStackChargeDisputeResolved = '{

        "event": "charge.dispute.resolve",
      
        "data": {
      
          "id": 358949,
      
          "refund_amount": 5700,
      
          "currency": "NGN",
      
          "status": "resolved",
      
          "resolution": "auto-accepted",
      
          "domain": "live",
      
          "transaction": {
      
            "id": 896467592,
      
            "domain": "live",
      
            "status": "reversed",
      
            "reference": "5qm4pv2mxs9rltp",
      
            "amount": 5700,
      
            "message": null,
      
            "gateway_response": "Approved",
      
            "paid_at": "2020-11-24T13:45:53.000Z",
      
            "created_at": "2020-11-24T13:45:52.000Z",
      
            "channel": "card",
      
            "currency": "NGN",
      
            "ip_address": null,
      
            "metadata": "",
      
            "log": null,
      
            "fees": 52,
      
            "fees_split": null,
      
            "authorization": {},
      
            "customer": {
      
              "international_format_phone": null
      
            },
      
            "plan": {},
      
            "subaccount": {},
      
            "split": {},
      
            "order_id": null,
      
            "paidAt": "2020-11-24T13:45:53.000Z",
      
            "requested_amount": 5700,
      
            "pos_transaction_data": null
      
          },
      
          "transaction_reference": null,
      
          "category": "chargeback",
      
          "customer": {
      
            "id": 5406463,
      
            "first_name": "John",
      
            "last_name": "Doe",
      
            "email": "john@example.com",
      
            "customer_code": "CUS_6wbxh6689vt0n7s",
      
            "phone": "0800000000",
      
            "metadata": {},
      
            "risk_action": "allow",
      
            "international_format_phone": null
      
          },
      
          "bin": "123456",
      
          "last4": "1234",
      
          "dueAt": "2020-11-24T14:00:00.000Z",
      
          "resolvedAt": "2020-11-24T14:00:02.000Z",
      
          "evidence": null,
      
          "attachments": null,
      
          "note": null,
      
          "history": [
      
            {
      
              "status": "pending",
      
              "by": "example@test.com",
      
              "createdAt": "2020-11-24T13:46:36.000Z"
      
            }
      
          ],
      
          "messages": [
      
            {
      
              "sender": "example@test.com",
      
              "body": "Customer complained about debit without value",
      
              "createdAt": "2020-11-24T13:46:36.000Z"
      
            }
      
          ],
      
          "created_at": "2020-11-24T13:46:36.000Z",
      
          "updated_at": "2020-11-24T14:00:02.000Z"
      
        }
      
      }';

      static $payStackDedicatedAccountAssignFailed = '{

        "event": "dedicatedaccount.assign.failed",
      
        "data": {
      
          "customer": {
      
            "id": 100110,
      
            "first_name": "John",
      
            "last_name": "Doe",
      
            "email": "johndoe@test.com",
      
            "customer_code": "CUS_hcekca0j0bbg2m4",
      
            "phone": "+2348100000000",
      
            "metadata": {},
      
            "risk_action": "default",
      
            "international_format_phone": "+2348100000000"
      
          },
      
          "dedicated_account": null,
      
          "identification": {
      
            "status": "failed"
      
          }
      
        }
      
      }';

      static $payStackDedicatedAccountAssignSuccess = '{

        "event": "dedicatedaccount.assign.success",
      
        "data": {
      
          "customer": {
      
            "id": 100110,
      
            "first_name": "John",
      
            "last_name": "Doe",
      
            "email": "johndoe@test.com",
      
            "customer_code": "CUS_hp05n9khsqcesz2",
      
            "phone": "+2348100000000",
      
            "metadata": {},
      
            "risk_action": "default",
      
            "international_format_phone": "+2348100000000"
      
          },
      
          "dedicated_account": {
      
            "bank": {
      
              "name": "Test Bank",
      
              "id": 20,
      
              "slug": "test-bank"
      
            },
      
            "account_name": "PAYSTACK/John Doe",
      
            "account_number": "1234567890",
      
            "assigned": true,
      
            "currency": "NGN",
      
            "metadata": null,
      
            "active": true,
      
            "id": 987654,
      
            "created_at": "2022-06-21T17:12:40.000Z",
      
            "updated_at": "2022-08-12T14:02:51.000Z",
      
            "assignment": {
      
              "integration": 100123,
      
              "assignee_id": 100110,
      
              "assignee_type": "Customer",
      
              "expired": false,
      
              "account_type": "PAY-WITH-TRANSFER-RECURRING",
      
              "assigned_at": "2022-08-12T14:02:51.614Z",
      
              "expired_at": null
      
            }
      
          },
      
          "identification": {
      
            "status": "success"
      
          }
      
        }
      
      }';

      static $payStackInvoiceCreated = '{

        "event": "invoice.create",
      
        "data": {
      
          "domain": "test",
      
          "invoice_code": "INV_thy2vkmirn2urwv",
      
          "amount": 50000,
      
          "period_start": "2018-12-20T15:00:00.000Z",
      
          "period_end": "2018-12-19T23:59:59.000Z",
      
          "status": "success",
      
          "paid": true,
      
          "paid_at": "2018-12-20T15:00:06.000Z",
      
          "description": null,
      
          "authorization": {
      
            "authorization_code": "AUTH_9246d0h9kl",
      
            "bin": "408408",
      
            "last4": "4081",
      
            "exp_month": "12",
      
            "exp_year": "2020",
      
            "channel": "card",
      
            "card_type": "visa DEBIT",
      
            "bank": "Test Bank",
      
            "country_code": "NG",
      
            "brand": "visa",
      
            "reusable": true,
      
            "signature": "SIG_iCw3p0rsG7LUiQwlsR3t",
      
            "account_name": "BoJack Horseman"
      
          },
      
          "subscription": {
      
            "status": "active",
      
            "subscription_code": "SUB_fq7dbe8tju0i1v8",
      
            "email_token": "3a1h7bcu8zxhm8k",
      
            "amount": 50000,
      
            "cron_expression": "0 * * * *",
      
            "next_payment_date": "2018-12-20T00:00:00.000Z",
      
            "open_invoice": null
      
          },
      
          "customer": {
      
            "id": 46,
      
            "first_name": "Asample",
      
            "last_name": "Personpaying",
      
            "email": "asam@ple.com",
      
            "customer_code": "CUS_00w4ath3e2ukno4",
      
            "phone": "",
      
            "metadata": null,
      
            "risk_action": "default"
      
          },
      
          "transaction": {
      
            "reference": "9cfbae6e-bbf3-5b41-8aef-d72c1a17650g",
      
            "status": "success",
      
            "amount": 50000,
      
            "currency": "NGN"
      
          },
      
          "created_at": "2018-12-20T15:00:02.000Z"
      
        }
      
      }';
      static $payStackInvoiceFailed = '{

        "event": "invoice.payment_failed",
      
        "data": {
      
          "domain": "test",
      
          "invoice_code": "INV_3kfmqw48ca7b48k",
      
          "amount": 10000,
      
          "period_start": "2019-03-25T14:00:00.000Z",
      
          "period_end": "2019-03-24T23:59:59.000Z",
      
          "status": "pending",
      
          "paid": false,
      
          "paid_at": null,
      
          "description": null,
      
          "authorization": {
      
            "authorization_code": "AUTH_fmmpvpvphp",
      
            "bin": "506066",
      
            "last4": "6666",
      
            "exp_month": "03",
      
            "exp_year": "2033",
      
            "channel": "card",
      
            "card_type": "verve ",
      
            "bank": "TEST BANK",
      
            "country_code": "NG",
      
            "brand": "verve",
      
            "reusable": true,
      
            "signature": "SIG_bx0C6uIiqFHnoGOxTDWr",
      
            "account_name": "BoJack Horseman"
      
          },
      
          "subscription": {
      
            "status": "active",
      
            "subscription_code": "SUB_f7ct8g01mtcjf78",
      
            "email_token": "gptk4apuohyyjsg",
      
            "amount": 10000,
      
            "cron_expression": "0 * * * *",
      
            "next_payment_date": "2019-03-25T00:00:00.000Z",
      
            "open_invoice": "INV_3kfmqw48ca7b48k"
      
          },
      
          "customer": {
      
            "id": 6910995,
      
            "first_name": null,
      
            "last_name": null,
      
            "email": "xxx@gmail.com",
      
            "customer_code": "CUS_3p3ylxyf07605kx",
      
            "phone": null,
      
            "metadata": null,
      
            "risk_action": "default"
      
          },
      
          "transaction": {},
      
          "created_at": "2019-03-25T14:00:03.000Z"
      
        }
      
      }';


      static $payStackInvoiceUpdated = '{

        "event": "invoice.update",
      
        "data": {
      
          "domain": "test",
      
          "invoice_code": "INV_kmhuaaur5c9ruh2",
      
          "amount": 50000,
      
          "period_start": "2016-04-19T07:00:00.000Z",
      
          "period_end": "2016-05-19T07:00:00.000Z",
      
          "status": "success",
      
          "paid": true,
      
          "paid_at": "2016-04-19T06:00:09.000Z",
      
          "description": null,
      
          "authorization": {
      
            "authorization_code": "AUTH_jhbldlt1",
      
            "bin": "539923",
      
            "last4": "2071",
      
            "exp_month": "10",
      
            "exp_year": "2017",
      
            "card_type": "MASTERCARD DEBIT",
      
            "bank": "FIRST BANK OF NIGERIA PLC",
      
            "country_code": "NG",
      
            "brand": "MASTERCARD",
      
            "account_name": "BoJack Horseman"
      
          },
      
          "subscription": {
      
            "status": "active",
      
            "subscription_code": "SUB_l07i1s6s39nmytr",
      
            "amount": 50000,
      
            "cron_expression": "0 0 19 * *",
      
            "next_payment_date": "2016-05-19T07:00:00.000Z",
      
            "open_invoice": null
      
          },
      
          "customer": {
      
            "first_name": "BoJack",
      
            "last_name": "Horseman",
      
            "email": "bojack@horsinaround.com",
      
            "customer_code": "CUS_xnxdt6s1zg1f4nx",
      
            "phone": "",
      
            "metadata": {},
      
            "risk_action": "default"
      
          },
      
          "transaction": {
      
            "reference": "rdtmivs7zf",
      
            "status": "success",
      
            "amount": 50000,
      
            "currency": "NGN"
      
          },
      
          "created_at": "2016-04-16T13:45:03.000Z"
      
        }
      
      }';

    static $payStackPaymentRequestPending = '{

        "event": "paymentrequest.pending",
      
        "data": {
      
          "id": 1089700,
      
          "domain": "test",
      
          "amount": 10000000,
      
          "currency": "NGN",
      
          "due_date": null,
      
          "has_invoice": false,
      
          "invoice_number": null,
      
          "description": "Pay up",
      
          "pdf_url": null,
      
          "line_items": [],
      
          "tax": [],
      
          "request_code": "PRQ_y0paeo93jh99mho",
      
          "status": "pending",
      
          "paid": false,
      
          "paid_at": null,
      
          "metadata": null,
      
          "notifications": [],
      
          "offline_reference": "3365451089700",
      
          "customer": 7454223,
      
          "created_at": "2019-06-21T15:25:42.000Z"
      
        }
      
      }';


      static $payStackPaymentRequestSuccessful = '{

        "event": "paymentrequest.success",
      
        "data": {
      
          "id": 1089700,
      
          "domain": "test",
      
          "amount": 10000000,
      
          "currency": "NGN",
      
          "due_date": null,
      
          "has_invoice": false,
      
          "invoice_number": null,
      
          "description": "Pay up now",
      
          "pdf_url": null,
      
          "line_items": [],
      
          "tax": [],
      
          "request_code": "PRQ_y0paeo93jh99mho",
      
          "status": "success",
      
          "paid": true,
      
          "paid_at": "2019-06-21T15:26:10.000Z",
      
          "metadata": null,
      
          "notifications": [
      
            {
      
              "sent_at": "2019-06-21T15:25:42.452Z",
      
              "channel": "email"
      
            }
      
          ],
      
          "offline_reference": "3365451089700",
      
          "customer": 7454223,
      
          "created_at": "2019-06-21T15:25:42.000Z"
      
        }
      
      }';


      static $payStackRefundFailed = '{

        "event": "refund.failed",
      
        "data": {
      
          "status": "failed",
      
          "transaction_reference": "T9171231_412325_3be2736c_n6tml",
      
          "refund_reference": "TRF_9vgfawjnoz58uxy",
      
          "amount": 20000,
      
          "currency": "NGN",
      
          "processor": "instant-transfer",
      
          "customer": {
      
            "first_name": "Tobi",
      
            "last_name": "Digz",
      
            "email": "tobi@mail.com"
      
          },
      
          "integration": 412325,
      
          "domain": "live"
      
        }
      
      }';

      static $payStackRefundPending = '{

        "event": "refund.pending",
      
        "data": {
      
          "status": "pending",
      
          "transaction_reference": "tvunjbbd_412829_4b18075d_c7had",
      
          "refund_reference": null,
      
          "amount": "10000",
      
          "currency": "NGN",
      
          "processor": "instant-transfer",
      
          "customer": {
      
            "first_name": "Drew",
      
            "last_name": "Berry",
      
            "email": "demo@email.com"
      
          },
      
          "integration": 412829,
      
          "domain": "live"
      
        }
      
      }';

      static $payStackRefundProcessed = '{

        "event": "refund.processed",
      
        "data": {
      
          "status": "processed",
      
          "transaction_reference": "T2154954_412829_3be32076_6lcg3",
      
          "refund_reference": "132013318360",
      
          "amount": "5000",
      
          "currency": "NGN",
      
          "processor": "mpgs_zen",
      
          "customer": {
      
            "first_name": "Damilola",
      
            "last_name": "Kwabena",
      
            "email": "damilola@email.com"
      
          },
      
          "integration": 412829,
      
          "domain": "live"
      
        }
      
      }';

      static $payStackRefundProcessing = '{

        "event": "refund.processing",
      
        "data": {
      
          "status": "processing",
      
          "transaction_reference": "tvunjbbd_412829_4b18075d_c7had",
      
          "refund_reference": null,
      
          "amount": "10000",
      
          "currency": "NGN",
      
          "processor": "instant-transfer",
      
          "customer": {
      
            "first_name": "Drew",
      
            "last_name": "Berry",
      
            "email": "demo@email.com"
      
          },
      
          "integration": 412829,
      
          "domain": "live"
      
        }
      
      }';


      static $payStackSubscriptionCreate = '{

        "event": "subscription.create",
      
        "data": {
      
          "domain": "test",
      
          "status": "active",
      
          "subscription_code": "SUB_vsyqdmlzble3uii",
      
          "amount": 50000,
      
          "cron_expression": "0 0 28 * *",
      
          "next_payment_date": "2016-05-19T07:00:00.000Z",
      
          "open_invoice": null,
      
          "createdAt": "2016-03-20T00:23:24.000Z",
      
          "plan": {
      
            "name": "Monthly retainer",
      
            "plan_code": "PLN_gx2wn530m0i3w3m",
      
            "description": null,
      
            "amount": 50000,
      
            "interval": "monthly",
      
            "send_invoices": true,
      
            "send_sms": true,
      
            "currency": "NGN"
      
          },
      
          "authorization": {
      
            "authorization_code": "AUTH_96xphygz",
      
            "bin": "539983",
      
            "last4": "7357",
      
            "exp_month": "10",
      
            "exp_year": "2017",
      
            "card_type": "MASTERCARD DEBIT",
      
            "bank": "GTBANK",
      
            "country_code": "NG",
      
            "brand": "MASTERCARD",
      
            "account_name": "BoJack Horseman"
      
          },
      
          "customer": {
      
            "first_name": "BoJack",
      
            "last_name": "Horseman",
      
            "email": "bojack@horsinaround.com",
      
            "customer_code": "CUS_xnxdt6s1zg1f4nx",
      
            "phone": "",
      
            "metadata": {},
      
            "risk_action": "default"
      
          },
      
          "created_at": "2016-10-01T10:59:59.000Z"
      
        }
      
      }';

      static $payStackSubscriptionDisable = '{

        "event": "subscription.disable",
      
        "data": {
      
          "domain": "test",
      
          "status": "complete",
      
          "subscription_code": "SUB_vsyqdmlzble3uii",
      
          "email_token": "ctt824k16n34u69",
      
          "amount": 300000,
      
          "cron_expression": "0 * * * *",
      
          "next_payment_date": "2020-11-26T15:00:00.000Z",
      
          "open_invoice": null,
      
          "plan": {
      
            "id": 67572,
      
            "name": "Monthly retainer",
      
            "plan_code": "PLN_gx2wn530m0i3w3m",
      
            "description": null,
      
            "amount": 50000,
      
            "interval": "monthly",
      
            "send_invoices": true,
      
            "send_sms": true,
      
            "currency": "NGN"
      
          },
      
          "authorization": {
      
            "authorization_code": "AUTH_96xphygz",
      
            "bin": "539983",
      
            "last4": "7357",
      
            "exp_month": "10",
      
            "exp_year": "2017",
      
            "card_type": "MASTERCARD DEBIT",
      
            "bank": "GTBANK",
      
            "country_code": "NG",
      
            "brand": "MASTERCARD",
      
            "account_name": "BoJack Horseman"
      
          },
      
          "customer": {
      
            "first_name": "BoJack",
      
            "last_name": "Horseman",
      
            "email": "bojack@horsinaround.com",
      
            "customer_code": "CUS_xnxdt6s1zg1f4nx",
      
            "phone": "",
      
            "metadata": {},
      
            "risk_action": "default"
      
          },
      
          "created_at": "2020-11-26T14:45:06.000Z"
      
        }
      
      }';

      static $payStackSubscriptionNotRenew = '{

        "event": "subscription.not_renew",
      
        "data": {
      
          "id": 317617,
      
          "domain": "test",
      
          "status": "non-renewing",
      
          "subscription_code": "SUB_d638sdiWAio7jnl",
      
          "email_token": "086x99rmqc4qhcw",
      
          "amount": 120000,
      
          "cron_expression": "0 0 8 10 *",
      
          "next_payment_date": null,
      
          "open_invoice": null,
      
          "integration": 116430,
      
          "plan": {
      
            "id": 103028,
      
            "name": "(1,200) - annually - [1 - Year]",
      
            "plan_code": "PLN_tlknnnzfi4w2evu",
      
            "description": "Subscription not_renewed for sub@notrenew.com",
      
            "amount": 120000,
      
            "interval": "annually",
      
            "send_invoices": true,
      
            "send_sms": true,
      
            "currency": "NGN"
      
          },
      
          "authorization": {
      
            "authorization_code": "AUTH_5ftfl9xrl0",
      
            "bin": "424242",
      
            "last4": "4081",
      
            "exp_month": "06",
      
            "exp_year": "2023",
      
            "channel": "card",
      
            "card_type": "mastercard debit",
      
            "bank": "Guaranty Trust Bank",
      
            "country_code": "NG",
      
            "brand": "mastercard",
      
            "reusable": true,
      
            "signature": "SIG_biPYZE4PgDCQUJMIT4sE",
      
            "account_name": null
      
          },
      
          "customer": {
      
            "id": 57199167,
      
            "first_name": null,
      
            "last_name": null,
      
            "email": "sub@notrenew.com",
      
            "customer_code": "CUS_8gbmdpvn12c67ix",
      
            "phone": null,
      
            "metadata": null,
      
            "risk_action": "default",
      
            "international_format_phone": null
      
          },
      
          "invoices": [],
      
          "invoices_history": [],
      
          "invoice_limit": 0,
      
          "split_code": null,
      
          "most_recent_invoice": null,
      
          "created_at": "2021-10-08T14:50:39.000Z"
      
        }
      
      }';

      static $payStackSubscriptionExpiringCards = '{

        "event": "subscription.expiring_cards",
      
        "data": [
      
          {
      
            "expiry_date": "12/2021",
      
            "description": "visa ending with 4081",
      
            "brand": "visa",
      
            "subscription": {
      
              "id": 94729,
      
              "subscription_code": "SUB_lejj927x2kxciw1",
      
              "amount": 44000,
      
              "next_payment_date": "2021-11-11T00:00:01.000Z",
      
              "plan": {
      
                "interval": "monthly",
      
                "id": 22637,
      
                "name": "Premium Service (Monthly)",
      
                "plan_code": "PLN_pfmwz75o021slex"
      
              }
      
            },
      
            "customer": {
      
              "id": 7808239,
      
              "first_name": "Bojack",
      
              "last_name": "Horseman",
      
              "email": "bojackhoresman@gmail.com",
      
              "customer_code": "CUS_8v6g420rc16spqw"
      
            }
      
          }
      
        ]
      
      }';


      static $payStackChargeSuccess = '{

        "event": "charge.success",
      
        "data": {
      
          "id": 302961,
      
          "domain": "live",
      
          "status": "success",
      
          "reference": "qTPrJoy9Bx",
      
          "amount": 10000,
      
          "message": null,
      
          "gateway_response": "Approved by Financial Institution",
      
          "paid_at": "2016-09-30T21:10:19.000Z",
      
          "created_at": "2016-09-30T21:09:56.000Z",
      
          "channel": "card",
      
          "currency": "NGN",
      
          "ip_address": "41.242.49.37",
      
          "metadata": 0,
      
          "log": {
      
            "time_spent": 16,
      
            "attempts": 1,
      
            "authentication": "pin",
      
            "errors": 0,
      
            "success": false,
      
            "mobile": false,
      
            "input": [],
      
            "channel": null,
      
            "history": [
      
              {
      
                "type": "input",
      
                "message": "Filled these fields: card number, card expiry, card cvv",
      
                "time": 15
      
              },
      
              {
      
                "type": "action",
      
                "message": "Attempted to pay",
      
                "time": 15
      
              },
      
              {
      
                "type": "auth",
      
                "message": "Authentication Required: pin",
      
                "time": 16
      
              }
      
            ]
      
          },
      
          "fees": null,
      
          "customer": {
      
            "id": 68324,
      
            "first_name": "BoJack",
      
            "last_name": "Horseman",
      
            "email": "bojack@horseman.com",
      
            "customer_code": "CUS_qo38as2hpsgk2r0",
      
            "phone": null,
      
            "metadata": null,
      
            "risk_action": "default"
      
          },
      
          "authorization": {
      
            "authorization_code": "AUTH_f5rnfq9p",
      
            "bin": "539999",
      
            "last4": "8877",
      
            "exp_month": "08",
      
            "exp_year": "2020",
      
            "card_type": "mastercard DEBIT",
      
            "bank": "Guaranty Trust Bank",
      
            "country_code": "NG",
      
            "brand": "mastercard",
      
            "account_name": "BoJack Horseman"
      
          },
      
          "plan": {}
      
        }
      
      }';

      static $payStackTransferSuccess = '{

        "event": "transfer.success",
      
        "data": {
      
          "amount": 30000,
      
          "currency": "NGN",
      
          "domain": "test",
      
          "failures": null,
      
          "id": 37272792,
      
          "integration": {
      
            "id": 463433,
      
            "is_live": true,
      
            "business_name": "Boom Boom Industries NG"
      
          },
      
          "reason": "Have fun...",
      
          "reference": "1jhbs3ozmen0k7y5efmw",
      
          "source": "balance",
      
          "source_details": null,
      
          "status": "success",
      
          "titan_code": null,
      
          "transfer_code": "TRF_wpl1dem4967avzm",
      
          "transferred_at": null,
      
          "recipient": {
      
            "active": true,
      
            "currency": "NGN",
      
            "description": "",
      
            "domain": "test",
      
            "email": null,
      
            "id": 8690817,
      
            "integration": 463433,
      
            "metadata": null,
      
            "name": "Jack Sparrow",
      
            "recipient_code": "RCP_a8wkxiychzdzfgs",
      
            "type": "nuban",
      
            "is_deleted": false,
      
            "details": {
      
              "account_number": "0000000000",
      
              "account_name": null,
      
              "bank_code": "011",
      
              "bank_name": "First Bank of Nigeria"
      
            },
      
            "created_at": "2020-09-03T12:11:25.000Z",
      
            "updated_at": "2020-09-03T12:11:25.000Z"
      
          },
      
          "session": {
      
            "provider": null,
      
            "id": null
      
          },
      
          "created_at": "2020-10-26T12:28:57.000Z",
      
          "updated_at": "2020-10-26T12:28:57.000Z"
      
        }
      
      }';

      static $payStackTransferFailed = '{

        "event": "transfer.failed",
      
        "data": {
      
          "amount": 200000,
      
          "currency": "NGN",
      
          "domain": "test",
      
          "failures": null,
      
          "id": 69123462,
      
          "integration": {
      
            "id": 100043,
      
            "is_live": true,
      
            "business_name": "Paystack"
      
          },
      
          "reason": "Enjoy",
      
          "reference": "1976435206",
      
          "source": "balance",
      
          "source_details": null,
      
          "status": "failed",
      
          "titan_code": null,
      
          "transfer_code": "TRF_chs98y5rykjb47w",
      
          "transferred_at": null,
      
          "recipient": {
      
            "active": true,
      
            "currency": "NGN",
      
            "description": null,
      
            "domain": "test",
      
            "email": "test@email.com",
      
            "id": 13584206,
      
            "integration": 100043,
      
            "metadata": null,
      
            "name": "Ted Lasso",
      
            "recipient_code": "RCP_cjcua8itre45gs",
      
            "type": "nuban",
      
            "is_deleted": false,
      
            "details": {
      
              "authorization_code": null,
      
              "account_number": "0123456789",
      
              "account_name": "Ted Lasso",
      
              "bank_code": "011",
      
              "bank_name": "First Bank of Nigeria"
      
            },
      
            "created_at": "2021-04-12T15:30:14.000Z",
      
            "updated_at": "2021-04-12T15:30:14.000Z"
      
          },
      
          "session": {
      
            "provider": "nip",
      
            "id": "74849400998877667"
      
          },
      
          "created_at": "2021-04-12T15:30:15.000Z",
      
          "updated_at": "2021-04-12T15:41:21.000Z"
      
        }
      
      }';

      static $payStackTransferReversed = '{

        "event": "transfer.reversed",
      
        "data": {
      
          "amount": 10000,
      
          "currency": "NGN",
      
          "domain": "live",
      
          "failures": null,
      
          "id": 20615868,
      
          "integration": {
      
            "id": 100073,
      
            "is_live": true,
      
            "business_name": "Night\'s Watch Inc"
      
          },
      
          "reason": "test balance ledger elastic changes",
      
          "reference": "jvrjckwenm",
      
          "source": "balance",
      
          "source_details": null,
      
          "status": "reversed",
      
          "titan_code": null,
      
          "transfer_code": "TRF_js075pj9u07f34l",
      
          "transferred_at": "2020-03-24T07:14:00.000Z",
      
          "recipient": {
      
            "active": true,
      
            "currency": "NGN",
      
            "description": null,
      
            "domain": "live",
      
            "email": "jon@sn.ow",
      
            "id": 1476759,
      
            "integration": 100073,
      
            "metadata": null,
      
            "name": "JON SNOW",
      
            "recipient_code": "RCP_hmcj8ciho490bvi",
      
            "type": "nuban",
      
            "is_deleted": false,
      
            "details": {
      
              "authorization_code": null,
      
              "account_number": "0000000000",
      
              "account_name": null,
      
              "bank_code": "011",
      
              "bank_name": "First Bank of Nigeria"
      
            },
      
            "created_at": "2019-04-10T08:39:10.000Z",
      
            "updated_at": "2019-11-27T20:43:57.000Z"
      
          },
      
          "session": {
      
            "provider": "nip",
      
            "id": "110006200324071331002061586801"
      
          },
      
          "created_at": "2020-03-24T07:13:31.000Z",
      
          "updated_at": "2020-03-24T07:14:55.000Z"
      
        }
      
      }';

    }

