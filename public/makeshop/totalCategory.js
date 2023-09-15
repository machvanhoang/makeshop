const allCategory = [
    {
        "name": "赤ワイン",
        "code": "ct636",
        "type" : "category",
    },
    {
        "name": "白ワイン",
        "code": "ct637",
        "type" : "category"
    },
    {
        "name": "ロゼワイン",
        "code": "ct639",
        "type" : "category"
    },
    {
        "name": "オレンジワイン",
        "code": "ct640", 
        "type" : "category"
    },
    {
        "name": "甘口ワイン",
        "code": "ct641",
        "type" : "category"
    },
    {
        "name": "スパークリングワイン",
        "code": "ct642",
        "type" : "category"
    },
    {
        "name": "低アルコール",
        "code": "ct1171",
        "type" : "category"
    },
    {
        "name": "日本",
        "code": "ct644",
        "type" : "origin",
    },
    {
        "name": "フランス",
        "code": "ct645",
        "type" : "origin",
    }, {
        "name": "ボルドー",
        "code": "ct656",
        "type" : "origin",
    },
    {
        "name": "サン・テステフ",
        "code": "ct711",
        "type" : "origin",
    },
    {
        "name": "ポイヤック",
        "code": "ct710",
        "type" : "origin",
    },
    {
        "name": "サン・ジュリアン",
        "code": "ct712",
        "type" : "origin",
    },
    {
        "name": "マルゴー",
        "code": "ct713",
        "type" : "origin",
    },
    {
        "name": "グラーヴ",
        "code": "ct714",
        "type" : "origin",
    },
    {
        "name": "ペサック・レオニャン",
        "code": "ct715",
        "type" : "origin",
    },
    {
        "name": "サン・テミリオン",
        "code": "ct716",
        "type" : "origin",
    },
    {
        "name": "ポムロール",
        "code": "ct717",
        "type" : "origin",
    },
    {
        "name": "メドック",
        "code": "ct718",
        "type" : "origin",
    },
    {
        "name": "ソーテルヌ地区",
        "code": "ct719",
        "type" : "origin",
    },
    {
        "name": "オー・メドック",
        "code": "ct720",
        "type" : "origin",
    },
    {
        "name": "その他　ボルドー",
        "code": "ct721",
        "type" : "origin",
    },
    {
        "name": "ブルゴーニュ",
        "code": "ct657",
        "type" : "origin",
    },
    {
        "name": "シャブリ",
        "code": "ct722",
        "type" : "origin",
    },
    {
        "name": "コート・ド・ニュイ",
        "code": "ct723",
        "type" : "origin",
    },
    {
        "name": "コート・ド・ボーヌ",
        "code": "ct724",
        "type" : "origin",
    },
    {
        "name": "コート・シャロネーズ",
        "code": "ct725",
        "type" : "origin",
    },
    {
        "name": "マコネ",
        "code": "ct726",
        "type" : "origin",
    },
    {
        "name": "シャンパーニュ",
        "code": "ct658",
        "type" : "origin",
    },
    {
        "name": "モンターニュ・ド・ランス",
        "code": "ct727",
        "type" : "origin",
    },
    {
        "name": "ヴァレ・ド・ラ・マルヌ",
        "code": "ct728",
        "type" : "origin",
    },
    {
        "name": "コート・デ・ブラン",
        "code": "ct729",
        "type" : "origin",
    }, {
        "name": "その他　シャンパーニュ",
        "code": "ct730",
        "type" : "origin",
    },
    {
        "name": "その他　フランス",
        "code": "ct659",
        "type" : "origin",
    },
    {
        "name": "アルザス",
        "code": "ct731",
        "type" : "origin",
    },
    {
        "name": "ローヌ",
        "code": "ct732",
        "type" : "origin",
    },
    {
        "name": "ロワール",
        "code": "ct733",
        "type" : "origin",
    }, {
        "name": "その他",
        "code": "ct734",
        "type" : "origin",
    },
    {
        "name": "イタリア",
        "code": "ct646",
        "type" : "origin",
    },
    {
        "name": "ピエモンテ",
        "code": "ct735",
        "type" : "origin",
    },
    {
        "name": "トスカーナ",
        "code": "ct736",
        "type" : "origin",
    },
    {
        "name": "その他　イタリア",
        "code": "ct737",
        "type" : "origin",
    },
    {
        "name": "スペイン",
        "code": "ct647",
        "type" : "origin",
    },
    {
        "name": "リオハ",
        "code": "ct738",
        "type" : "origin",
    },
    {
        "name": "リベラ・デル・デュエロ",
        "code": "ct739",
        "type" : "origin",
    },
    {
        "name": "カタルーニャ",
        "code": "ct740",
        "type" : "origin",
    },
    {
        "name": "その他　スペイン",
        "code": "ct741",
        "type" : "origin",
    },
    {
        "name": "その他　ヨーロッパ",
        "code": "ct648",
        "type" : "origin",
    },
    {
        "name": "アメリカ",
        "code": "ct649",
        "type" : "origin",
    },
    {
        "name": "カリフォルニア州",
        "code": "ct742",
        "type" : "origin",
    },
    {
        "name": "ナパ",
        "code": "ct748",
        "type" : "origin",
    },
    {
        "name": "ソノマ",
        "code": "ct749",
        "type" : "origin",
    },
    {
        "name": "メンドシーノ",
        "code": "ct750",
        "type" : "origin",
    },
    {
        "name": "セントラル・コースト",
        "code": "ct751",
        "type" : "origin",
    },
    {
        "name": "オレゴン州",
        "code": "ct743",
        "type" : "origin",
    },
    {
        "name": "ワシントン州",
        "code": "ct744",
        "type" : "origin",
    },
    {
        "name": "チリ",
        "code": "ct650",
        "type" : "origin",
    },
    {
        "name": "その他　南米",
        "code": "ct651",
        "type" : "origin",
    },
    {
        "name": "ニュージーランド",
        "code": "ct652",
        "type" : "origin",
    },
    {
        "name": "北島",
        "code": "ct746",
        "type" : "origin",
    },
    {
        "name": "南島",
        "code": "ct747",
        "type" : "origin",
    },
    {
        "name": "オーストラリア",
        "code": "ct653",
        "type" : "origin",
    },
    {
        "name": "南アフリカ",
        "code": "ct654",
        "type" : "origin",
    },
    {
        "name": "その他の産地",
        "code": "ct655",
        "type" : "origin",
    },
    {
        "name": "カベルネ・ソーヴィニヨン",
        "code": "ct661",
        "type" : "type",
    },
    {
        "name": "メルロー",
        "code": "ct662",
        "type" : "type",
    },
    {
        "name": "ピノ・ノワール",
        "code": "ct663",
        "type" : "type",
    },
    {
        "name": "シャルドネ",
        "code": "ct664",
        "type" : "type",
    },
    {
        "name": "リースリング",
        "code": "ct665",
        "type" : "type",
    },
    {
        "name": "ソーヴィニヨン・ブラン",
        "code": "ct666",
        "type" : "type",
    },
    {
        "name": "その他　赤ワイン",
        "code": "ct667",
        "type" : "type",
    }
    , {
        "name": "マスカット・ベリーA",
        "code": "ct669",
        "type" : "type",
    },
    {
        "name": "サンジョベーゼ",
        "code": "ct670",
        "type" : "type",
    },
    {
        "name": "ネッビオーロ",
        "code": "ct671",
        "type" : "type",
    },
    {
        "name": "テンプラニーリョ",
        "code": "ct672",
        "type" : "type",
    },
    {
        "name": "ジンファンデル",
        "code": "ct673",
        "type" : "type",
    },
    {
        "name": "マルベック",
        "code": "ct674",
        "type" : "type",
    },
    {
        "name": "シラー(シラーズ)",
        "code": "ct675",
        "type" : "type",
    },
    {
        "name": "その他",
        "code": "ct676",
        "type" : "type",
    },
    {
        "name": "その他　白ワイン",
        "code": "ct677",
        "type" : "type",
    },
    {
        "name": "甲州",
        "code": "ct678",
        "type" : "type",
    },
    {
        "name": "デラウェア",
        "code": "ct679",
        "type" : "type",
    },
    {
        "name": "アリゴテ",
        "code": "ct680",
        "type" : "type",
    },
    {
        "name": "グリューナー・ヴェルトリナー",
        "code": "ct681",
        "type" : "type",
    },
    {
        "name": "シュナン・ブラン",
        "code": "ct682",
        "type" : "type",
    },
    {
        "name": "その他",
        "code": "ct683",
        "type" : "type",
    },
    {
        "name": "ピュア【スパークリングワイン】",
        "code": "ct1278",
        "type" : "body",
    },
    {
        "name": "ハーモニー【スパークリングワイン】",
        "code": "ct1279",
        "type" : "body",
    },
    {
        "name": "リッチ【スパークリングワイン】",
        "code": "ct1280",
        "type" : "body",
    },
    {
        "name": "軽やか【白ワイン】",
        "code": "ct1281",
        "type" : "body",
    },
    {
        "name": "軽コク【白ワイン】",
        "code": "ct1282",
        "type" : "body",
    },
    {
        "name": "コク旨【白ワイン】",
        "code": "ct1283",
        "type" : "body",
    },
    {
        "name": "ソフト【赤ワイン】",
        "code": "ct1307",
        "type" : "body",
    },
    {
        "name": "ソフ深【赤ワイン】",
        "code": "ct1308",
        "type" : "body",
    },
    {
        "name": "コク深【赤ワイン】",
        "code": "ct1309",
        "type" : "body",
    },
    {
        "name": "～500ml",
        "code": "ct690",
        "type" : "size",
    },
    {
        "name": "750ml",
        "code": "ct691",
        "type" : "size",
    },
    {
        "name": "1500ml～",
        "code": "ct692",
        "type" : "size",
    },
    {
        "name": "～2000年",
        "code": "ct686",
        "type" : "vintage",
    },
    {
        "name": "2001年～2010年",
        "code": "ct687",
        "type" : "vintage"
    },
    {
        "name": "2011年〜2020年",
        "code": "ct688",
        "type" : "vintage"
    },
    {
        "name": "2021年〜",
        "code": "ct263",
        "type" : "vintage"
    },
    {
        "name": "ボルドー",
        "code": "ct700",
        "type" : "ranker",
    },
    {
        "name": "メドック　1級",
        "code": "ct702",
        "type" : "ranker",
    },
    {
        "name": "メドック　2級",
        "code": "ct703",
        "type" : "ranker",
    },
    {
        "name": "メドック　3級",
        "code": "ct704",
        "type" : "ranker",
    },
    {
        "name": "メドック　4級",
        "code": "ct705",
        "type" : "ranker",
    },
    {
        "name": "メドック　5級",
        "code": "ct706",
        "type" : "ranker",
    },
    {
        "name": "2nd ワイン",
        "code": "ct934",
        "type" : "ranker",
    },
    {
        "name": "ブルゴーニュ",
        "code": "ct701",
        "type" : "ranker",
    },
    {
        "name": "特級",
        "code": "ct707",
        "type" : "ranker",
    },
    {
        "name": "1級",
        "code": "ct708",
        "type" : "ranker",
    },
    {
        "name": "シャンパーニュ",
        "code": "ct935",
        "type" : "ranker",
    },
    {
        "name": "特級",
        "code": "ct937",
        "type" : "ranker",
    },
    {
        "id": 2,
        "name": "1級",
        "code": "ct938",
        "type" : "ranker",
    }
];
function getCheckedCategory(array_checked = []) {
    let array = [];
    allCategory.forEach(element => {
        if (array_checked.includes(element.code)) {
            array.push(element);
        }
    });
    return array;
}