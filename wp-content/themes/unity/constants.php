<?php

// Action List - Associate

define("ACT_SHOW_NEW_FORM", "new");
define("ACT_SHOW_UPD_FORM", "update");
define("ACT_UPDATE_RECORD", "update_record");
define("ACT_INSERT_RECORD", "insert_record");

// Action List - Finance

define("ACT_GEN_ANUIDADE", "generate");

// Pagseguro URL

define("PAGSEGURO_ENVIRONMENT", "sandbox");
define("PAGSEGURO_EMAIL",       "pagseguro@sbau.org.br");

// Production

define("PROD_PAGSEGURO_TOKEN",        "C25E493E2D554C93A06D77C9BB920CC7");
define("PROD_PAGSEGURO_CHECKOUT",     "https://ws.pagseguro.uol.com.br/v2/checkout");
define("PROD_PAGSEGURO_NOTIFICATION", "https://ws.pagseguro.uol.com.br/v3/transactions/notifications");
define("PROD_PAGSEGURO_PAYMENT",      "https://pagseguro.uol.com.br/v2/checkout/payment.html?code=");

// Sandbox

define("SAND_PAGSEGURO_TOKEN",        "7FE7227D90554233B048D6B0435D51CE");
define("SAND_PAGSEGURO_CHECKOUT",     "https://ws.sandbox.pagseguro.uol.com.br/v2/checkout/");
define("SAND_PAGSEGURO_NOTIFICATION", "https://ws.sandbox.pagseguro.uol.com.br/v3/transactions/notifications");
define("SAND_PAGSEGURO_PAYMENT",      "https://sandbox.pagseguro.uol.com.br/v2/checkout/payment.html?code=");

// Current configuration

define("PAGSEGURO_TOKEN",        PAGSEGURO_ENVIRONMENT == 'sandbox' ? SAND_PAGSEGURO_TOKEN        : PROD_PAGSEGURO_TOKEN);
define("PAGSEGURO_CHECKOUT",     PAGSEGURO_ENVIRONMENT == 'sandbox' ? SAND_PAGSEGURO_CHECKOUT     : PROD_PAGSEGURO_CHECKOUT);
define("PAGSEGURO_NOTIFICATION", PAGSEGURO_ENVIRONMENT == 'sandbox' ? SAND_PAGSEGURO_NOTIFICATION : PROD_PAGSEGURO_NOTIFICATION);
define("PAGSEGURO_PAYMENT",      PAGSEGURO_ENVIRONMENT == 'sandbox' ? SAND_PAGSEGURO_PAYMENT      : PROD_PAGSEGURO_PAYMENT);

// Pagseguro Status

define("ST_PENDENTE",   0);
define("ST_AGUARDANDO", 1);
define("ST_EM_ANALISE", 2);
define("ST_PAGA",       3);
define("ST_DISPONIVEL", 4);
define("ST_EM_DISPUTA", 5);
define("ST_DEVOLVIDA",  6);
define("ST_CANCELADA",  7);

// Values

define("ANUIDADE_PADRAO_VAL",     "150.00");
define("ANUIDADE_PADRAO_DESC",    "Anuidade padrão" );

define("ANUIDADE_ESTUDANTE_VAL",  "60.00");
define("ANUIDADE_ESTUDANTE_DESC", "Anuidade estudante");

?>
