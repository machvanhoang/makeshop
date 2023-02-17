const allCategory = [
    {
        "name": "赤ワイン",
        "code": "ct636"
    },
    {
        "name": "白ワイン",
        "code": "ct637"
    },
    {
        "name": "ロゼワイン",
        "code": "ct639"
    },
    {
        "name": "オレンジワイン",
        "code": "ct640"
    },
    {
        "name": "甘口ワイン",
        "code": "ct641"
    },
    {
        "name": "スパークリングワイン",
        "code": "ct642"
    },
    {
        "name": "低アルコール",
        "code": "ct1171"
    },
    {
        "name": "日本",
        "code": "ct644",
    },
    {
        "name": "フランス",
        "code": "ct645"
    }, {
        "name": "ボルドー",
        "code": "ct656"
    },
    {
        "name": "サン・テステフ",
        "code": "ct711",
    },
    {
        "name": "ポイヤック",
        "code": "ct710",
    },
    {
        "name": "サン・ジュリアン",
        "code": "ct712",
    },
    {
        "name": "マルゴー",
        "code": "ct713",
    },
    {
        "name": "グラーヴ",
        "code": "ct714",
    },
    {
        "name": "ペサック・レオニャン",
        "code": "ct715",
    },
    {
        "name": "サン・テミリオン",
        "code": "ct716",
    },
    {
        "name": "ポムロール",
        "code": "ct717",
    },
    {
        "name": "メドック",
        "code": "ct718",
    },
    {
        "name": "ソーテルヌ地区",
        "code": "ct719",
    },
    {
        "name": "オー・メドック",
        "code": "ct720",
    },
    {
        "name": "その他　ボルドー",
        "code": "ct721",
    },
    {
        "name": "ブルゴーニュ",
        "code": "ct657",
    },
    {
        "name": "シャブリ",
        "code": "ct722",
    },
    {
        "name": "コート・ド・ニュイ",
        "code": "ct723",
    },
    {
        "name": "コート・ド・ボーヌ",
        "code": "ct724",
    },
    {
        "name": "コート・シャロネーズ",
        "code": "ct725",
    },
    {
        "name": "マコネ",
        "code": "ct726",
    },
    {
        "name": "シャンパーニュ",
        "code": "ct658",
    },
    {
        "name": "モンターニュ・ド・ランス",
        "code": "ct727",
    },
    {
        "name": "ヴァレ・ド・ラ・マルヌ",
        "code": "ct728",
    },
    {
        "name": "コート・デ・ブラン",
        "code": "ct729",
    }, {
        "name": "その他　シャンパーニュ",
        "code": "ct730",
    },
    {
        "name": "その他　フランス",
        "code": "ct659",
    },
    {
        "name": "アルザス",
        "code": "ct731",
    },
    {
        "name": "ローヌ",
        "code": "ct732",
    },
    {
        "name": "ロワール",
        "code": "ct733",
    }, {
        "name": "その他",
        "code": "ct734",
    },
    {
        "name": "イタリア",
        "code": "ct646",
    },
    {
        "name": "ピエモンテ",
        "code": "ct735",
    },
    {
        "name": "トスカーナ",
        "code": "ct736",
    },
    {
        "name": "その他　イタリア",
        "code": "ct737",
    },
    {
        "name": "スペイン",
        "code": "ct647",
    },
    {
        "name": "リオハ",
        "code": "ct738",
    },
    {
        "name": "リベラ・デル・デュエロ",
        "code": "ct739",
    },
    {
        "name": "カタルーニャ",
        "code": "ct740",
    },
    {
        "name": "その他　スペイン",
        "code": "ct741",
    },
    {
        "name": "その他　ヨーロッパ",
        "code": "ct648",
    },
    {
        "name": "アメリカ",
        "code": "ct649",
    },
    {
        "name": "カリフォルニア州",
        "code": "ct742",
    },
    {
        "name": "ナパ",
        "code": "ct748",
    },
    {
        "name": "ソノマ",
        "code": "ct749",
    },
    {
        "name": "メンドシーノ",
        "code": "ct750",
    },
    {
        "name": "セントラル・コースト",
        "code": "ct751",
    },
    {
        "name": "オレゴン州",
        "code": "ct743",
    },
    {
        "name": "ワシントン州",
        "code": "ct744",
    },
    {
        "name": "チリ",
        "code": "ct650",
    },
    {
        "name": "その他　南米",
        "code": "ct651",
    },
    {
        "name": "ニュージーランド",
        "code": "ct652",
    },
    {
        "name": "北島",
        "code": "ct746",
    },
    {
        "name": "南島",
        "code": "ct747",
    },
    {
        "name": "オーストラリア",
        "code": "ct653",
    },
    {
        "name": "南アフリカ",
        "code": "ct654",
    },
    {
        "name": "その他の産地",
        "code": "ct655",
    },
    {
        "name": "カベルネ・ソーヴィニヨン",
        "code": "ct661",
    },
    {
        "name": "メルロー",
        "code": "ct662",
    },
    {
        "name": "ピノ・ノワール",
        "code": "ct663",
    },
    {
        "name": "シャルドネ",
        "code": "ct664",
    },
    {
        "name": "リースリング",
        "code": "ct665",
    },
    {
        "name": "ソーヴィニヨン・ブラン",
        "code": "ct666",
    },
    {
        "name": "その他　赤ワイン",
        "code": "ct667",
    }
    , {
        "name": "マスカット・ベリーA",
        "code": "ct669",
    },
    {
        "name": "サンジョベーゼ",
        "code": "ct670",
    },
    {
        "name": "ネッビオーロ",
        "code": "ct671",
    },
    {
        "name": "テンプラニーリョ",
        "code": "ct672",
    },
    {
        "name": "ジンファンデル",
        "code": "ct673",
    },
    {
        "name": "マルベック",
        "code": "ct674",
    },
    {
        "name": "シラー(シラーズ)",
        "code": "ct675",
    },
    {
        "name": "その他",
        "code": "ct676",
    },
    {
        "name": "その他　白ワイン",
        "code": "ct677",
    },
    {
        "name": "甲州",
        "code": "ct678",
    },
    {
        "name": "デラウェア",
        "code": "ct679",
    },
    {
        "name": "アリゴテ",
        "code": "ct680",
    },
    {
        "name": "グリューナー・ヴェルトリナー",
        "code": "ct681",
    },
    {
        "name": "シュナン・ブラン",
        "code": "ct682",
    },
    {
        "name": "その他",
        "code": "ct683",
    },
    {
        "name": "ピュア【スパークリングワイン】",
        "code": "ct1278",
    },
    {
        "name": "ハーモニー【スパークリングワイン】",
        "code": "ct1279",
    },
    {
        "name": "リッチ【スパークリングワイン】",
        "code": "ct1280",
    },
    {
        "name": "軽やか【白ワイン】",
        "code": "ct1281",
    },
    {
        "name": "軽コク【白ワイン】",
        "code": "ct1282",
    },
    {
        "name": "コク旨【白ワイン】",
        "code": "ct1283",
    },
    {
        "name": "ソフト【赤ワイン】",
        "code": "ct1307",
    },
    {
        "name": "ソフ深【赤ワイン】",
        "code": "ct1308",
    },
    {
        "name": "コク深【赤ワイン】",
        "code": "ct1309",
    },
    {
        "name": "～500ml",
        "code": "ct690"
    },
    {
        "name": "750ml",
        "code": "ct691"
    },
    {
        "name": "1500ml～",
        "code": "ct692"
    },
    {
        "name": "～2000年",
        "code": "ct686"
    },
    {
        "name": "2001年～2010年",
        "code": "ct687"
    },
    {
        "name": "2011年～",
        "code": "ct688"
    },
    {
        "name": "ボルドー",
        "code": "ct700",
    },
    {
        "name": "メドック　1級",
        "code": "ct702"
    },
    {
        "name": "メドック　2級",
        "code": "ct703"
    },
    {
        "name": "メドック　3級",
        "code": "ct704"
    },
    {
        "name": "メドック　4級",
        "code": "ct705"
    },
    {
        "name": "メドック　5級",
        "code": "ct706"
    },
    {
        "name": "2nd ワイン",
        "code": "ct934"
    },
    {
        "name": "ブルゴーニュ",
        "code": "ct701",
    },
    {
        "name": "特級",
        "code": "ct707"
    },
    {
        "name": "1級",
        "code": "ct708"
    },
    {
        "name": "シャンパーニュ",
        "code": "ct935",
    },
    {
        "name": "特級",
        "code": "ct937"
    },
    {
        "id": 2,
        "name": "1級",
        "code": "ct938"
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