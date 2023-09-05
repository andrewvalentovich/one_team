const allCountries = [
  {
    name: "Afghanistan (‫افغانستان‬‎)",
    iso2: "af",
    dialCode: "93",
    mask: '+93 (___) ___-__-__'
  },
  {
    name: "Albania (Shqipëri)",
    iso2: "al",
    dialCode: "355",
    mask: '+355 (___) ___-___'
  },
  {
    name: "Algeria (‫الجزائر‬‎)",
    iso2: "dz",
    dialCode: "213",
    mask: '+213 (___) ___-____'
  },
  {
    name: "American Samoa",
    iso2: "as",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Andorra",
    iso2: "ad",
    dialCode: "376",
    mask: '+376 (___) ___-___'
  },
  {
    name: "Angola",
    iso2: "ao",
    dialCode: "244",
    mask: '+244 (___) ___-____'
  },
  {
    name: "Anguilla",
    iso2: "ai",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Antigua and Barbuda",
    iso2: "ag",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Argentina",
    iso2: "ar",
    dialCode: "54",
    mask: '+54 (___) ___-____'
  },
  {
    name: "Armenia (Հայաստան)",
    iso2: "am",
    dialCode: "374",
    mask: '+374 (___) ___-___'
  },
  {
    name: "Aruba",
    iso2: "aw",
    dialCode: "297",
    mask: '+297 (___) ___-___'
  },
  {
    name: "Ascension Island",
    iso2: "ac",
    dialCode: "247",
    mask: '+247 (___) ___-___'
  },
  {
    name: "Australia",
    iso2: "au",
    dialCode: "61",
    mask: '+61 (__) ___-___'
  },
  {
    name: "Austria (Österreich)",
    iso2: "at",
    dialCode: "43",
    mask: '+43 (___) ___-___'
  },
  {
    name: "Azerbaijan (Azərbaycan)",
    iso2: "az",
    dialCode: "994",
    mask: '+994 (___) ___-___'
  },
  {
    name: "Bahamas",
    iso2: "bs",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Bahrain (‫البحرين‬‎)",
    iso2: "bh",
    dialCode: "973",
    mask: '+973 (___) ___-___'
  },
  {
    name: "Bangladesh (বাংলাদেশ)",
    iso2: "bd",
    dialCode: "880",
    mask: '+880 (___) ___-___'
  },
  {
    name: "Barbados",
    iso2: "bb",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Belarus (Беларусь)",
    iso2: "by",
    dialCode: "375",
    mask: '+375 (__) ___-__-__'
  },
  {
    name: "Belgium (België)",
    iso2: "be",
    dialCode: "32",
    mask: '+32 (___) ___-___'
  },
  {
    name: "Belize",
    iso2: "bz",
    dialCode: "501",
    mask: '+501 (___) ___-____'
  },
  {
    name: "Benin (Bénin)",
    iso2: "bj",
    dialCode: "229",
    mask: '+229 (___) ___-____'
  },
  {
    name: "Bermuda",
    iso2: "bm",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Bhutan (འབྲུག)",
    iso2: "bt",
    dialCode: "975",
    mask: '+975 (___) ___-___'
  },
  {
    name: "Bolivia",
    iso2: "bo",
    dialCode: "591",
    mask: '+591 (___) ___-____'
  },
  {
    name: "Bosnia and Herzegovina (Босна и Херцеговина)",
    iso2: "ba",
    dialCode: "387",
    mask: '+387 (___) ___-___'
  },
  {
    name: "Botswana",
    iso2: "bw",
    dialCode: "267",
    mask: '+267 (___) ___-____'
  },
  {
    name: "Brazil (Brasil)",
    iso2: "br",
    dialCode: "55",
    mask: '+55 (__) _____-____'
  },
  {
    name: "British Indian Ocean Territory",
    iso2: "io",
    dialCode: "246",
    mask: '+246 (___) ___-___'
  },
  {
    name: "British Virgin Islands",
    iso2: "vg",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Brunei",
    iso2: "bn",
    dialCode: "673",
    mask: '+673 (___) ___-____'
  },
  {
    name: "Bulgaria (България)",
    iso2: "bg",
    dialCode: "359",
    mask: '+359 (___) ___-___'
  },
  {
    name: "Burkina Faso",
    iso2: "bf",
    dialCode: "226",
    mask: '+226 (___) ___-___'
  },
  {
    name: "Burundi (Uburundi)",
    iso2: "bi",
    dialCode: "257",
    mask: '+257 (___) ___-___'
  },
  {
    name: "Cambodia (កម្ពុជា)",
    iso2: "kh",
    dialCode: "855",
    mask: '+855 (___) ___-___'
  },
  {
    name: "Cameroon (Cameroun)",
    iso2: "cm",
    dialCode: "237",
    mask: '+237 (___) ___-___'
  },
  {
    name: "Canada",
    iso2: "ca",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Cape Verde (Kabu Verdi)",
    iso2: "cv",
    dialCode: "238",
    mask: '+238 (___) ___-___'
  },
  {
    name: "Caribbean Netherlands",
    iso2: "bq",
    dialCode: "599",
    mask: '+599 (___) ___-____'
  },
  {
    name: "Cayman Islands",
    iso2: "ky",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Central African Republic (République centrafricaine)",
    iso2: "cf",
    dialCode: "236",
    mask: '+236 (___) ___-___'
  },
  {
    name: "Chad (Tchad)",
    iso2: "td",
    dialCode: "235",
    mask: '+235 (___) ___-___'
  },
  {
    name: "Chile",
    iso2: "cl",
    dialCode: "56",
    mask: '+56 (___) ___-____'
  },
  {
    name: "China (中国)",
    iso2: "cn",
    dialCode: "86",
    mask: '+86 (___) ___-___'
  },
  {
    name: "Christmas Island",
    iso2: "cx",
    dialCode: "61",
    mask: '+61 (___) ___-___'
  },
  {
    name: "Cocos (Keeling) Islands",
    iso2: "cc",
    dialCode: "61",
    mask: '+61 (___) ___-___'
  },
  {
    name: "Colombia",
    iso2: "co",
    dialCode: "57",
    mask: '+57 (___) ___-____'
  },
  {
    name: "Comoros (‫جزر القمر‬‎)",
    iso2: "km",
    dialCode: "269",
    mask: '+269 (___) ___-___'
  },
  {
    name: "Congo (DRC) (Jamhuri ya Kidemokrasia ya Kongo)",
    iso2: "cd",
    dialCode: "243",
    mask: '+243 (___) ___-___'
  },
  {
    name: "Congo (Republic) (Congo-Brazzaville)",
    iso2: "cg",
    dialCode: "242",
    mask: '+242 (___) ___-___'
  },
  {
    name: "Cook Islands",
    iso2: "ck",
    dialCode: "682",
    mask: '+682 (___) ___-___'
  },
  {
    name: "Costa Rica",
    iso2: "cr",
    dialCode: "506",
    mask: '+506 (___) ___-____'
  },
  {
    name: "Côte d'Ivoire",
    iso2: "ci",
    dialCode: "225",
    mask: '+225 (___) ___-___'
  },
  {
    name: "Croatia (Hrvatska)",
    iso2: "hr",
    dialCode: "385",
    mask: '+385 (___) ___-___'
  },
  {
    name: "Cuba",
    iso2: "cu",
    dialCode: "53",
    mask: '+53 (___) ___-___'
  },
  {
    name: "Curaçao",
    iso2: "cw",
    dialCode: "599",
    mask: '+599 (___) ___-____'
  },
  {
    name: "Cyprus (Κύπρος)",
    iso2: "cy",
    dialCode: "357",
    mask: '+357 (___) ___-___'
  },
  {
    name: "Czech Republic (Česká republika)",
    iso2: "cz",
    dialCode: "420",
    mask: '+420 (___) ___-___'
  },
  {
    name: "Denmark (Danmark)",
    iso2: "dk",
    dialCode: "45",
    mask: '+45 (___) ___-___'
  },
  {
    name: "Djibouti",
    iso2: "dj",
    dialCode: "253",
    mask: '+253 (___) ___-___'
  },
  {
    name: "Dominica",
    iso2: "dm",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Dominican Republic (República Dominicana)",
    iso2: "do",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Ecuador",
    iso2: "ec",
    dialCode: "593",
    mask: '+593 (___) ___-____'
  },
  {
    name: "Egypt (‫مصر‬‎)",
    iso2: "eg",
    dialCode: "20",
    mask: '+20 (___) ___-____'
  },
  {
    name: "El Salvador",
    iso2: "sv",
    dialCode: "503",
    mask: '+503 (___) ___-____'
  },
  {
    name: "Equatorial Guinea (Guinea Ecuatorial)",
    iso2: "gq",
    dialCode: "240",
    mask: '+240 (___) ___-___'
  },
  {
    name: "Eritrea",
    iso2: "er",
    dialCode: "291",
    mask: '+291 (___) ___-___'
  },
  {
    name: "Estonia (Eesti)",
    iso2: "ee",
    dialCode: "372",
    mask: '+372 (___) ___-___'
  },
  {
    name: "Ethiopia",
    iso2: "et",
    dialCode: "251",
    mask: '+251 (___) ___-___'
  },
  {
    name: "Falkland Islands (Islas Malvinas)",
    iso2: "fk",
    dialCode: "500",
    mask: '+500 (___) ___-___'
  },
  {
    name: "Faroe Islands (Føroyar)",
    iso2: "fo",
    dialCode: "298",
    mask: '+298 (___) ___-___'
  },
  {
    name: "Fiji",
    iso2: "fj",
    dialCode: "679",
    mask: '+679 (___) ___-___'
  },
  {
    name: "Finland (Suomi)",
    iso2: "fi",
    dialCode: "358",
    mask: '+358 (___) ___-___'
  },
  {
    name: "France",
    iso2: "fr",
    dialCode: "33",
    mask: '+33 (___) ___-____'
  },
  {
    name: "French Guiana (Guyane française)",
    iso2: "gf",
    dialCode: "594",
    mask: '+594 (___) ___-___'
  },
  {
    name: "French Polynesia (Polynésie française)",
    iso2: "pf",
    dialCode: "689",
    mask: '+689 (___) ___-___'
  },
  {
    name: "Gabon",
    iso2: "ga",
    dialCode: "241",
    mask: '+241 (___) ___-___'
  },
  {
    name: "Gambia",
    iso2: "gm",
    dialCode: "220",
    mask: '+220 (___) ___-___'
  },
  {
    name: "Georgia (საქართველო)",
    iso2: "ge",
    dialCode: "995",
    mask: '+995 (___) ___-___'
  },
  {
    name: "Germany (Deutschland)",
    iso2: "de",
    dialCode: "49",
    mask: '+49 (___) ___-___'
  },
  {
    name: "Ghana (Gaana)",
    iso2: "gh",
    dialCode: "233",
    mask: '+233 (___) ___-___'
  },
  {
    name: "Gibraltar",
    iso2: "gi",
    dialCode: "350",
    mask: '+350 (___) ___-___'
  },
  {
    name: "Greece (Ελλάδα)",
    iso2: "gr",
    dialCode: "30",
    mask: '+30 (___) ___-___'
  },
  {
    name: "Greenland (Kalaallit Nunaat)",
    iso2: "gl",
    dialCode: "299",
    mask: '+299 (___) ___-___'
  },
  {
    name: "Grenada",
    iso2: "gd",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Guadeloupe",
    iso2: "gp",
    dialCode: "590",
    mask: '+590 (___) ___-___'
  },
  {
    name: "Guam",
    iso2: "gu",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Guatemala",
    iso2: "gt",
    dialCode: "502",
    mask: '+502 (___) ___-____'
  },
  {
    name: "Guernsey",
    iso2: "gg",
    dialCode: "44",
    mask: '+44 (___) ___-___'
  },
  {
    name: "Guinea (Guinée)",
    iso2: "gn",
    dialCode: "224",
    mask: '+224 (___) ___-___'
  },
  {
    name: "Guinea-Bissau (Guiné Bissau)",
    iso2: "gw",
    dialCode: "245",
    mask: '+245 (___) ___-___'
  },
  {
    name: "Guyana",
    iso2: "gy",
    dialCode: "592",
    mask: '+592 (___) ___-___'
  },
  {
    name: "Haiti",
    iso2: "ht",
    dialCode: "509",
    mask: '+509 (___) ___-____'
  },
  {
    name: "Honduras",
    iso2: "hn",
    dialCode: "504",
    mask: '+504 (___) ___-____'
  },
  {
    name: "Hong Kong (香港)",
    iso2: "hk",
    dialCode: "852",
    mask: '+852 (___) ___-___'
  },
  {
    name: "Hungary (Magyarország)",
    iso2: "hu",
    dialCode: "36",
    mask: '+36 (___) ___-___'
  },
  {
    name: "Iceland (Ísland)",
    iso2: "is",
    dialCode: "354",
    mask: '+354 (___) ___-___'
  },
  {
    name: "India (भारत)",
    iso2: "in",
    dialCode: "91",
    mask: '+91 (___) ___-____'
  },
  {
    name: "Indonesia",
    iso2: "id",
    dialCode: "62",
    mask: '+62 (___) ___-___'
  },
  {
    name: "Iran (‫ایران‬‎)",
    iso2: "ir",
    dialCode: "98",
    mask: '+98 (___) ___-____'
  },
  {
    name: "Iraq (‫العراق‬‎)",
    iso2: "iq",
    dialCode: "964",
    mask: '+964 (___) ___-____'
  },
  {
    name: "Ireland",
    iso2: "ie",
    dialCode: "353",
    mask: '+353 (___) ___-____'
  },
  {
    name: "Isle of Man",
    iso2: "im",
    dialCode: "44",
    mask: '+44 (___) ___-___'
  },
  {
    name: "Israel (‫ישראל‬‎)",
    iso2: "il",
    dialCode: "972",
    mask: '+972 (___) ___-____'
  },
  {
    name: "Italy (Italia)",
    iso2: "it",
    dialCode: "39",
    mask: '+39 (___) ___-____'
  },
  {
    name: "Jamaica",
    iso2: "jm",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Japan (日本)",
    iso2: "jp",
    dialCode: "81",
    mask: '+81 (___) ___-____'
  },
  {
    name: "Jersey",
    iso2: "je",
    dialCode: "44",
    mask: '+44 (___) ___-___'
  },
  {
    name: "Jordan (‫الأردن‬‎)",
    iso2: "jo",
    dialCode: "962",
    mask: '+962 (___) ___-___'
  },
  {
    name: "Kazakhstan (Казахстан)",
    iso2: "kz",
    dialCode: "7",
    mask: '+7 (___) ___-__-__'
  },
  {
    name: "Kenya",
    iso2: "ke",
    dialCode: "254",
    mask: '+254 (___) ___-___'
  },
  {
    name: "Kiribati",
    iso2: "ki",
    dialCode: "686",
    mask: '+686 (___) ___-___'
  },
  {
    name: "Kuwait (‫الكويت‬‎)",
    iso2: "kw",
    dialCode: "965",
    mask: '+965 (___) ___-___'
  },
  {
    name: "Kyrgyzstan (Кыргызстан)",
    iso2: "kg",
    dialCode: "996",
    mask: '+996 (___) ___-___'
  },
  {
    name: "Laos (ລາວ)",
    iso2: "la",
    dialCode: "856",
    mask: '+856 (___) ___-___'
  },
  {
    name: "Latvia (Latvija)",
    iso2: "lv",
    dialCode: "371",
    mask: '+371 (___) ___-___'
  },
  {
    name: "Lebanon (‫لبنان‬‎)",
    iso2: "lb",
    dialCode: "961",
    mask: '+961 (___) ___-___'
  },
  {
    name: "Lesotho",
    iso2: "ls",
    dialCode: "266",
    mask: '+266 (___) ___-___'
  },
  {
    name: "Liberia",
    iso2: "lr",
    dialCode: "231",
    mask: '+231 (___) ___-___'
  },
  {
    name: "Libya (‫ليبيا‬‎)",
    iso2: "ly",
    dialCode: "218",
    mask: '+218 (___) ___-___'
  },
  {
    name: "Liechtenstein",
    iso2: "li",
    dialCode: "423",
    mask: '+423 (___) ___-___'
  },
  {
    name: "Lithuania (Lietuva)",
    iso2: "lt",
    dialCode: "370",
    mask: '+370 (___) ___-___'
  },
  {
    name: "Luxembourg",
    iso2: "lu",
    dialCode: "352",
    mask: '+352 (___) ___-___'
  },
  {
    name: "Macau (澳門)",
    iso2: "mo",
    dialCode: "853",
    mask: '+853 (___) ___-___'
  },
  {
    name: "Macedonia (FYROM) (Македонија)",
    iso2: "mk",
    dialCode: "389",
    mask: '+389 (___) ___-___'
  },
  {
    name: "Madagascar (Madagasikara)",
    iso2: "mg",
    dialCode: "261",
    mask: '+261 (___) ___-___'
  },
  {
    name: "Malawi",
    iso2: "mw",
    dialCode: "265",
    mask: '+265 (___) ___-___'
  },
  {
    name: "Malaysia",
    iso2: "my",
    dialCode: "60",
    mask: '+60 (___) ___-___'
  },
  {
    name: "Maldives",
    iso2: "mv",
    dialCode: "960",
    mask: '+960 (___) ___-___'
  },
  {
    name: "Mali",
    iso2: "ml",
    dialCode: "223",
    mask: '+223 (___) ___-___'
  },
  {
    name: "Malta",
    iso2: "mt",
    dialCode: "356",
    mask: '+356 (___) ___-___'
  },
  {
    name: "Marshall Islands",
    iso2: "mh",
    dialCode: "692",
    mask: '+692 (___) ___-___'
  },
  {
    name: "Martinique",
    iso2: "mq",
    dialCode: "596",
    mask: '+596 (___) ___-___'
  },
  {
    name: "Mauritania (‫موريتانيا‬‎)",
    iso2: "mr",
    dialCode: "222",
    mask: '+222 (___) ___-___'
  },
  {
    name: "Mauritius (Moris)",
    iso2: "mu",
    dialCode: "230",
    mask: '+230 (___) ___-___'
  },
  {
    name: "Mayotte",
    iso2: "yt",
    dialCode: "262",
    mask: '+262 (___) ___-___'
  },
  {
    name: "Mexico (México)",
    iso2: "mx",
    dialCode: "52",
    mask: '+52 (___) ___-____'
  },
  {
    name: "Micronesia",
    iso2: "fm",
    dialCode: "691",
    mask: '+691 (___) ___-___'
  },
  {
    name: "Moldova (Republica Moldova)",
    iso2: "md",
    dialCode: "373",
    mask: '+373 (___) ___-___'
  },
  {
    name: "Monaco",
    iso2: "mc",
    dialCode: "377",
    mask: '+377 (___) ___-___'
  },
  {
    name: "Mongolia (Монгол)",
    iso2: "mn",
    dialCode: "976",
    mask: '+976 (___) ___-___'
  },
  {
    name: "Montenegro (Crna Gora)",
    iso2: "me",
    dialCode: "382",
    mask: '+382 (___) ___-___'
  },
  {
    name: "Montserrat",
    iso2: "ms",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Morocco (‫المغرب‬‎)",
    iso2: "ma",
    dialCode: "212",
    mask: '+212 (___) ___-___'
  },
  {
    name: "Mozambique (Moçambique)",
    iso2: "mz",
    dialCode: "258",
    mask: '+258 (___) ___-___'
  },
  {
    name: "Myanmar (Burma) (မြန်မာ)",
    iso2: "mm",
    dialCode: "95",
    mask: '+95 (___) ___-___'
  },
  {
    name: "Namibia (Namibië)",
    iso2: "na",
    dialCode: "264",
    mask: '+264 (___) ___-___'
  },
  {
    name: "Nauru",
    iso2: "nr",
    dialCode: "674",
    mask: '+674 (___) ___-___'
  },
  {
    name: "Nepal (नेपाल)",
    iso2: "np",
    dialCode: "977",
    mask: '+977 (___) ___-___'
  },
  {
    name: "Netherlands (Nederland)",
    iso2: "nl",
    dialCode: "31",
    mask: '+31 (___) ___-___'
  },
  {
    name: "New Caledonia (Nouvelle-Calédonie)",
    iso2: "nc",
    dialCode: "687",
    mask: '+687 (___) ___-___'
  },
  {
    name: "New Zealand",
    iso2: "nz",
    dialCode: "64",
    mask: '+64 (___) ___-___'
  },
  {
    name: "Nicaragua",
    iso2: "ni",
    dialCode: "505",
    mask: '+505 (___) ___-____'
  },
  {
    name: "Niger (Nijar)",
    iso2: "ne",
    dialCode: "227",
    mask: '+227 (___) ___-___'
  },
  {
    name: "Nigeria",
    iso2: "ng",
    dialCode: "234",
    mask: '+234 (___) ___-___'
  },
  {
    name: "Niue",
    iso2: "nu",
    dialCode: "683",
    mask: '+683 (___) ___-___'
  },
  {
    name: "Norfolk Island",
    iso2: "nf",
    dialCode: "672",
    mask: '+672 (___) ___-___'
  },
  {
    name: "North Korea (조선 민주주의 인민 공화국)",
    iso2: "kp",
    dialCode: "850",
    mask: '+850 (___) ___-___'
  },
  {
    name: "Northern Mariana Islands",
    iso2: "mp",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Norway (Norge)",
    iso2: "no",
    dialCode: "47",
    mask: '+47 (___) ___-___'
  },
  {
    name: "Oman (‫عُمان‬‎)",
    iso2: "om",
    dialCode: "968",
    mask: '+968 (___) ___-___'
  },
  {
    name: "Pakistan (‫پاکستان‬‎)",
    iso2: "pk",
    dialCode: "92",
    mask: '+92 (___) ___-___'
  },
  {
    name: "Palau",
    iso2: "pw",
    dialCode: "680",
    mask: '+680 (___) ___-___'
  },
  {
    name: "Palestine (‫فلسطين‬‎)",
    iso2: "ps",
    dialCode: "970",
    mask: '+970 (___) ___-___'
  },
  {
    name: "Panama (Panamá)",
    iso2: "pa",
    dialCode: "507",
    mask: '+507 (___) ___-____'
  },
  {
    name: "Papua New Guinea",
    iso2: "pg",
    dialCode: "675",
    mask: '+675 (___) ___-___'
  },
  {
    name: "Paraguay",
    iso2: "py",
    dialCode: "595",
    mask: '+595 (___) ___-___'
  },
  {
    name: "Peru (Perú)",
    iso2: "pe",
    dialCode: "51",
    mask: '+51 (___) ___-____'
  },
  {
    name: "Philippines",
    iso2: "ph",
    dialCode: "63",
    mask: '+63 (___) ___-___'
  },
  {
    name: "Poland (Polska)",
    iso2: "pl",
    dialCode: "48",
    mask: '+48 (___) ___-___'
  },
  {
    name: "Portugal",
    iso2: "pt",
    dialCode: "351",
    mask: '+351 (___) ___-___'
  },
  {
    name: "Puerto Rico",
    iso2: "pr",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Qatar (‫قطر‬‎)",
    iso2: "qa",
    dialCode: "974",
    mask: '+974 (___) ___-___'
  },
  {
    name: "Réunion (La Réunion)",
    iso2: "re",
    dialCode: "262",
    mask: '+262 (___) ___-___'
  },
  {
    name: "Romania (România)",
    iso2: "ro",
    dialCode: "40",
    mask: '+40 (___) ___-___'
  },
  {
    name: "Russia (Россия)",
    iso2: "ru",
    dialCode: "7",
    mask: '+7 (___) ___-__-__'
  },
  {
    name: "Rwanda",
    iso2: "rw",
    dialCode: "250",
    mask: '+250 (___) ___-___'
  },
  {
    name: "Saint Barthélemy (Saint-Barthélemy)",
    iso2: "bl",
    dialCode: "590",
    mask: '+590 (___) ___-___'
  },
  {
    name: "Saint Helena",
    iso2: "sh",
    dialCode: "290",
    mask: '+290 (___) ___-___'
  },
  {
    name: "Saint Kitts and Nevis",
    iso2: "kn",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Saint Lucia",
    iso2: "lc",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Saint Martin (Saint-Martin)",
    iso2: "mf",
    dialCode: "590",
    mask: '+590 (___) ___-___'
  },
  {
    name: "Saint Pierre and Miquelon (Saint-Pierre-et-Miquelon)",
    iso2: "pm",
    dialCode: "508",
    mask: '+508 (___) ___-___'
  },
  {
    name: "Saint Vincent and the Grenadines",
    iso2: "vc",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Samoa",
    iso2: "ws",
    dialCode: "685",
    mask: '+685 (___) ___-___'
  },
  {
    name: "San Marino",
    iso2: "sm",
    dialCode: "378",
    mask: '+378 (___) ___-___'
  },
  {
    name: "São Tomé and Príncipe (São Tomé e Príncipe)",
    iso2: "st",
    dialCode: "239",
    mask: '+239 (___) ___-___'
  },
  {
    name: "Saudi Arabia (‫المملكة العربية السعودية‬‎)",
    iso2: "sa",
    dialCode: "966",
    mask: '+966 (___) ___-___'
  },
  {
    name: "Senegal (Sénégal)",
    iso2: "sn",
    dialCode: "221",
    mask: '+221 (___) ___-___'
  },
  {
    name: "Serbia (Србија)",
    iso2: "rs",
    dialCode: "381",
    mask: '+381 (___) ___-___'
  },
  {
    name: "Seychelles",
    iso2: "sc",
    dialCode: "248",
    mask: '+248 (___) ___-___'
  },
  {
    name: "Sierra Leone",
    iso2: "sl",
    dialCode: "232",
    mask: '+232 (___) ___-___'
  },
  {
    name: "Singapore",
    iso2: "sg",
    dialCode: "65",
    mask: '+65 (___) ___-___'
  },
  {
    name: "Sint Maarten",
    iso2: "sx",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Slovakia (Slovensko)",
    iso2: "sk",
    dialCode: "421",
    mask: '+421 (___) ___-___'
  },
  {
    name: "Slovenia (Slovenija)",
    iso2: "si",
    dialCode: "386",
    mask: '+386 (___) ___-___'
  },
  {
    name: "Solomon Islands",
    iso2: "sb",
    dialCode: "677",
    mask: '+677 (___) ___-___'
  },
  {
    name: "Somalia (Soomaaliya)",
    iso2: "so",
    dialCode: "252",
    mask: '+252 (___) ___-___'
  },
  {
    name: "South Africa",
    iso2: "za",
    dialCode: "27",
    mask: '+27 (___) ___-___'
  },
  {
    name: "South Korea (대한민국)",
    iso2: "kr",
    dialCode: "82",
    mask: '+82 (___) ___-____'
  },
  {
    name: "South Sudan (‫جنوب السودان‬‎)",
    iso2: "ss",
    dialCode: "211",
    mask: '+211 (___) ___-___'
  },
  {
    name: "Spain (España)",
    iso2: "es",
    dialCode: "34",
    mask: '+34 (___) ___-___'
  },
  {
    name: "Sri Lanka (ශ්‍රී ලංකාව)",
    iso2: "lk",
    dialCode: "94",
    mask: '+94 (___) ___-___'
  },
  {
    name: "Sudan (‫السودان‬‎)",
    iso2: "sd",
    dialCode: "249",
    mask: '+249 (___) ___-___'
  },
  {
    name: "Suriname",
    iso2: "sr",
    dialCode: "597",
    mask: '+597 (___) ___-___'
  },
  {
    name: "Svalbard and Jan Mayen",
    iso2: "sj",
    dialCode: "47",
    mask: '+47 (___) ___-___'
  },
  {
    name: "Swaziland",
    iso2: "sz",
    dialCode: "268",
    mask: '+268 (___) ___-___'
  },
  {
    name: "Sweden (Sverige)",
    iso2: "se",
    dialCode: "46",
    mask: '+46 (___) ___-___'
  },
  {
    name: "Switzerland (Schweiz)",
    iso2: "ch",
    dialCode: "41",
    mask: '+41 (___) ___-___'
  },
  {
    name: "Syria (‫سوريا‬‎)",
    iso2: "sy",
    dialCode: "963",
    mask: '+963 (___) ___-___'
  },
  {
    name: "Taiwan (台灣)",
    iso2: "tw",
    dialCode: "886",
    mask: '+886 (___) ___-___'
  },
  {
    name: "Tajikistan",
    iso2: "tj",
    dialCode: "992",
    mask: '+992 (___) ___-___'
  },
  {
    name: "Tanzania",
    iso2: "tz",
    dialCode: "255",
    mask: '+255 (___) ___-___'
  },
  {
    name: "Thailand (ไทย)",
    iso2: "th",
    dialCode: "66",
    mask: '+66 (___) ___-___'
  },
  {
    name: "Timor-Leste",
    iso2: "tl",
    dialCode: "670",
    mask: '+670 (___) ___-___'
  },
  {
    name: "Togo",
    iso2: "tg",
    dialCode: "228",
    mask: '+228 (___) ___-___'
  },
  {
    name: "Tokelau",
    iso2: "tk",
    dialCode: "690",
    mask: '+690 (___) ___-___'
  },
  {
    name: "Tonga",
    iso2: "to",
    dialCode: "676",
    mask: '+676 (___) ___-___'
  },
  {
    name: "Trinidad and Tobago",
    iso2: "tt",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Tunisia (‫تونس‬‎)",
    iso2: "tn",
    dialCode: "216",
    mask: '+216 (___) ___-___'
  },
  {
    name: "Turkey (Türkiye)",
    iso2: "tr",
    dialCode: "90",
    mask: '+90 (___) ___-___'
  },
  {
    name: "Turkmenistan",
    iso2: "tm",
    dialCode: "993",
    mask: '+993 (___) ___-___'
  },
  {
    name: "Turks and Caicos Islands",
    iso2: "tc",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Tuvalu",
    iso2: "tv",
    dialCode: "688",
    mask: '+688 (___) ___-___'
  },
  {
    name: "U.S. Virgin Islands",
    iso2: "vi",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Uganda",
    iso2: "ug",
    dialCode: "256",
    mask: '+256 (___) ___-___'
  },
  {
    name: "Ukraine (Україна)",
    iso2: "ua",
    dialCode: "380",
    mask: '+380 (___) ___-___'
  },
  {
    name: "United Arab Emirates (‫الإمارات العربية المتحدة‬‎)",
    iso2: "ae",
    dialCode: "971",
    mask: '+971 (___) ___-___'
  },
  {
    name: "United Kingdom",
    iso2: "gb",
    dialCode: "44",
    mask: '+44 (___) ___-___'
  },
  {
    name: "United States",
    iso2: "us",
    dialCode: "1",
    mask: '+1 (___) ___-____'
  },
  {
    name: "Uruguay",
    iso2: "uy",
    dialCode: "598",
    mask: '+598 (___) ___-___'
  },
  {
    name: "Uzbekistan (Oʻzbekiston)",
    iso2: "uz",
    dialCode: "998",
    mask: '+998 (___) ___-___'
  },
  {
    name: "Vanuatu",
    iso2: "vu",
    dialCode: "678",
    mask: '+678 (___) ___-___'
  },
  {
    name: "Vatican City (Città del Vaticano)",
    iso2: "va",
    dialCode: "39",
    mask: '+39 (___) ___-____'
  },
  {
    name: "Venezuela",
    iso2: "ve",
    dialCode: "58",
    mask: '+58 (___) ___-___'
  },
  {
    name: "Vietnam (Việt Nam)",
    iso2: "vn",
    dialCode: "84",
    mask: '+84 (___) ___-___'
  },
  {
    name: "Wallis and Futuna",
    iso2: "wf",
    dialCode: "681",
    mask: '+681 (___) ___-___'
  },
  {
    name: "Western Sahara (‫الصحراء الغربية‬‎)",
    iso2: "eh",
    dialCode: "212",
    mask: '+212 (___) ___-___'
  },
  {
    name: "Yemen (‫اليمن‬‎)",
    iso2: "ye",
    dialCode: "967",
    mask: '+967 (___) ___-___'
  },
  {
    name: "Zambia",
    iso2: "zm",
    dialCode: "260",
    mask: '+260 (___) ___-___'
  },
  {
    name: "Zimbabwe",
    iso2: "zw",
    dialCode: "263",
    mask: '+263 (___) ___-___'
  }
];

