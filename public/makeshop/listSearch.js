
function getCategories() {
  const _data = [
    {
      "id": 1,
      "name": "赤ワイン",
      "code": "ct636"
    },
    {
      "id": 2,
      "name": "白ワイン",
      "code": "ct637"
    },
    {
      "id": 3,
      "name": "ロゼワイン",
      "code": "ct639"
    },
    {
      "id": 4,
      "name": "オレンジワイン",
      "code": "ct640"
    },
    {
      "id": 5,
      "name": "甘口ワイン",
      "code": "ct641"
    },
    {
      "id": 6,
      "name": "スパークリングワイン",
      "code": "ct642"
    },
    {
      "id": 7,
      "name": "低アルコール",
      "code": "ct1171"
    }
  ];
  return _data;
}
function getOrigin() {
  const _data = [
    {
      "id": 1,
      "name": "日本",
      "code": "ct644",
      "child": false,
      "array_child": []
    },
    {
      "id": 2,
      "name": "フランス",
      "code": "ct645",
      "child": true,
      "array_child": [
        {
          "id": 1,
          "name": "ボルドー",
          "code": "ct656",
          "child": true,
          "array_child": [
            {
              "id": 1,
              "name": "サン・テステフ",
              "code": "ct711",
            },
            {
              "id": 2,
              "name": "ポイヤック",
              "code": "ct710",
            },
            {
              "id": 3,
              "name": "サン・ジュリアン",
              "code": "ct712",
            },
            {
              "id": 4,
              "name": "マルゴー",
              "code": "ct713",
            },
            {
              "id": 5,
              "name": "グラーヴ",
              "code": "ct714",
            },
            {
              "id": 6,
              "name": "ペサック・レオニャン",
              "code": "ct715",
            },
            {
              "id": 7,
              "name": "サン・テミリオン",
              "code": "ct716",
            },
            {
              "id": 8,
              "name": "ポムロール",
              "code": "ct717",
            },
            {
              "id": 9,
              "name": "メドック",
              "code": "ct718",
            },
            {
              "id": 10,
              "name": "ソーテルヌ地区",
              "code": "ct719",
            },
            {
              "id": 11,
              "name": "オー・メドック",
              "code": "ct720",
            },
            {
              "id": 12,
              "name": "その他　ボルドー",
              "code": "ct721",
            },
          ]
        },
        {
          "id": 2,
          "name": "ブルゴーニュ",
          "code": "ct657",
          "child": true,
          "array_child": [
            {
              "id": 1,
              "name": "シャブリ",
              "code": "ct722",
            },
            {
              "id": 2,
              "name": "コート・ド・ニュイ",
              "code": "ct723",
            },
            {
              "id": 3,
              "name": "コート・ド・ボーヌ",
              "code": "ct724",
            },
            {
              "id": 4,
              "name": "コート・シャロネーズ",
              "code": "ct725",
            },
            {
              "id": 5,
              "name": "マコネ",
              "code": "ct726",
            }
          ]
        },
        {
          "id": 3,
          "name": "シャンパーニュ",
          "code": "ct658",
          "child": true,
          "array_child": [
            {
              "id": 1,
              "name": "モンターニュ・ド・ランス",
              "code": "ct727",
            },
            {
              "id": 2,
              "name": "ヴァレ・ド・ラ・マルヌ",
              "code": "ct728",
            },
            {
              "id": 3,
              "name": "コート・デ・ブラン",
              "code": "ct729",
            }, {
              "id": 4,
              "name": "その他　シャンパーニュ",
              "code": "ct730",
            }
          ]
        },
        {
          "id": 4,
          "name": "その他　フランス",
          "code": "ct659",
          "child": true,
          "array_child": [
            {
              "id": 1,
              "name": "アルザス",
              "code": "ct731",
            },
            {
              "id": 2,
              "name": "ローヌ",
              "code": "ct732",
            },
            {
              "id": 3,
              "name": "ロワール",
              "code": "ct733",
            }, {
              "id": 4,
              "name": "その他",
              "code": "ct734",
            }
          ]
        }
      ]
    },
    {
      "id": 3,
      "name": "イタリア",
      "code": "ct646",
      "child": true,
      "array_child": [
        {
          "id": 1,
          "name": "ピエモンテ",
          "code": "ct735",
        },
        {
          "id": 2,
          "name": "トスカーナ",
          "code": "ct736",
        },
        {
          "id": 3,
          "name": "その他　イタリア",
          "code": "ct737",
        },
      ]
    },
    {
      "id": 4,
      "name": "スペイン",
      "code": "ct647",
      "child": true,
      "array_child": [
        {
          "id": 1,
          "name": "リオハ",
          "code": "ct738",
        },
        {
          "id": 2,
          "name": "リベラ・デル・デュエロ",
          "code": "ct739",
        },
        {
          "id": 3,
          "name": "カタルーニャ",
          "code": "ct740",
        },
        {
          "id": 4,
          "name": "その他　スペイン",
          "code": "ct741",
        }
      ]
    },
    {
      "id": 5,
      "name": "その他　ヨーロッパ",
      "code": "ct648",
      "child": false,
      "array_child": []
    },
    {
      "id": 6,
      "name": "アメリカ",
      "code": "ct649",
      "child": true,
      "array_child": [
        {
          "id": 1,
          "name": "カリフォルニア州",
          "code": "ct742",
          "child": true,
          "array_child": [
            {
              "id": 1,
              "name": "ナパ",
              "code": "ct748",
            },
            {
              "id": 2,
              "name": "ソノマ",
              "code": "ct749",
            },
            {
              "id": 3,
              "name": "メンドシーノ",
              "code": "ct750",
            },
            {
              "id": 4,
              "name": "セントラル・コースト",
              "code": "ct751",
            }
          ]
        },
        {
          "id": 2,
          "name": "オレゴン州",
          "code": "ct743",
        },
        {
          "id": 3,
          "name": "ワシントン州",
          "code": "ct744",
        }
      ]
    },
    {
      "id": 7,
      "name": "チリ",
      "code": "ct650",
      "child": false,
      "array_child": []
    },
    {
      "id": 8,
      "name": "その他　南米",
      "code": "ct651",
      "child": false,
      "array_child": []
    },
    {
      "id": 9,
      "name": "ニュージーランド",
      "code": "ct652",
      "child": true,
      "array_child": [
        {
          "id": 1,
          "name": "北島",
          "code": "ct746",
          "child": false,
        },
        {
          "id": 2,
          "name": "南島",
          "code": "ct747",
          "child": false,
        }
      ]
    },
    {
      "id": 10,
      "name": "オーストラリア",
      "code": "ct653",
      "child": false,
      "array_child": []
    },
    {
      "id": 11,
      "name": "南アフリカ",
      "code": "ct654",
      "child": false,
      "array_child": []
    },
    {
      "id": 12,
      "name": "その他の産地",
      "code": "ct655",
      "child": false,
      "array_child": []
    }
  ];
  return _data;
}
function getType() {
  const _data = [
    {
      "id": 1,
      "name": "カベルネ・ソーヴィニヨン",
      "code": "ct661",
      "child": false,
      "array_child": []
    },
    {
      "id": 2,
      "name": "メルロー",
      "code": "ct662",
      "child": false,
      "array_child": []
    },
    {
      "id": 3,
      "name": "ピノ・ノワール",
      "code": "ct663",
      "child": false,
      "array_child": []
    },
    {
      "id": 4,
      "name": "シャルドネ",
      "code": "ct664",
      "child": false,
      "array_child": []
    },
    {
      "id": 5,
      "name": "リースリング",
      "code": "ct665",
      "child": false,
      "array_child": []
    },
    {
      "id": 6,
      "name": "ソーヴィニヨン・ブラン",
      "code": "ct666",
      "child": false,
      "array_child": []
    },
    {
      "id": 7,
      "name": "その他　赤ワイン",
      "code": "ct667",
      "child": true,
      "array_child": [
        {
          "id": 1,
          "name": "マスカット・ベリーA",
          "code": "ct669",
          "child": false,
          "array_child": []
        },
        {
          "id": 2,
          "name": "サンジョベーゼ",
          "code": "ct670",
          "child": false,
          "array_child": []
        },
        {
          "id": 3,
          "name": "ネッビオーロ",
          "code": "ct671",
          "child": false,
          "array_child": []
        },
        {
          "id": 4,
          "name": "テンプラニーリョ",
          "code": "ct672",
          "child": false,
          "array_child": []
        },
        {
          "id": 5,
          "name": "ジンファンデル",
          "code": "ct673",
          "child": false,
          "array_child": []
        },
        {
          "id": 6,
          "name": "マルベック",
          "code": "ct674",
          "child": false,
          "array_child": []
        },
        {
          "id": 7,
          "name": "シラー(シラーズ)",
          "code": "ct675",
          "child": false,
          "array_child": []
        },
        {
          "id": 8,
          "name": "その他",
          "code": "ct676",
          "child": false,
          "array_child": []
        }
      ]
    },
    {
      "id": 7,
      "name": "その他　白ワイン",
      "code": "ct677",
      "child": true,
      "array_child": [
        {
          "id": 1,
          "name": "甲州",
          "code": "ct678",
          "child": false,
          "array_child": []
        },
        {
          "id": 2,
          "name": "デラウェア",
          "code": "ct679",
          "child": false,
          "array_child": []
        },
        {
          "id": 3,
          "name": "アリゴテ",
          "code": "ct680",
          "child": false,
          "array_child": []
        },
        {
          "id": 4,
          "name": "グリューナー・ヴェルトリナー",
          "code": "ct681",
          "child": false,
          "array_child": []
        },
        {
          "id": 5,
          "name": "シュナン・ブラン",
          "code": "ct682",
          "child": false,
          "array_child": []
        },
        {
          "id": 6,
          "name": "その他",
          "code": "ct683",
          "child": false,
          "array_child": []
        }
      ]
    },
  ];
  return _data;
}
function getBody() {
  const _data = [
    {
      "id": 1,
      "name": "ピュア【スパークリングワイン】",
      "code": "ct1278",
      "power": 1
    },
    {
      "id": 2,
      "name": "ハーモニー【スパークリングワイン】",
      "code": "ct1279",
      "power": 2
    },
    {
      "id": 3,
      "name": "リッチ【スパークリングワイン】",
      "code": "ct1280",
      "power": 3
    },
    {
      "id": 4,
      "name": "軽やか【白ワイン】",
      "code": "ct1281",
      "power": 1
    },
    {
      "id": 5,
      "name": "軽コク【白ワイン】",
      "code": "ct1282",
      "power": 2
    },
    {
      "id": 6,
      "name": "コク旨【白ワイン】",
      "code": "ct1283",
      "power": 3
    },
    {
      "id": 7,
      "name": "ソフト【赤ワイン】",
      "code": "ct1307",
      "power": 1
    },
    {
      "id": 8,
      "name": "ソフ深【赤ワイン】",
      "code": "ct1308",
      "power": 2
    },
    {
      "id": 9,
      "name": "コク深【赤ワイン】",
      "code": "ct1309",
      "power": 3
    }
  ];
  return _data;
}
function getSize() {
  const _data = [
    {
      "id": 1,
      "name": "すべて",
      "code": "all",
      "codes": [
        "ct690",
        "ct691",
        "ct692"
      ]
    },
    {
      "id": 2,
      "name": "～500ml",
      "code": "ct690"
    },
    {
      "id": 3,
      "name": "750ml",
      "code": "ct691"
    },
    {
      "id": 4,
      "name": "1500ml～",
      "code": "ct692"
    }
  ];
  return _data;
}
function getVintage() {
  const _data = [
    {
      "id": 1,
      "name": "すべて",
      "code": "all",
      "codes": [
        "ct686",
        "ct687",
        "ct688"
      ]
    },
    {
      "id": 2,
      "name": "～2000年",
      "code": "ct686"
    },
    {
      "id": 3,
      "name": "2001年～2010年",
      "code": "ct687"
    },
    {
      "id": 4,
      "name": "2011年～",
      "code": "ct688"
    }
  ];
  return _data;
}
function getRanker() {
  const _data = [
    {
      "id": 1,
      "name": "すべて",
      "code": "all",
      "codes": [
        "ct702",
        "ct703",
        "ct704",
        "ct705",
        "ct706",
        "ct934"
      ]
    },
    {
      "id": 2,
      "name": "ボルドー",
      "code": "ct700",
      "child": true,
      "array_child": [
        {
          "id": 1,
          "name": "メドック　1級",
          "code": "ct702"
        },
        {
          "id": 2,
          "name": "メドック　2級",
          "code": "ct703"
        },
        {
          "id": 3,
          "name": "メドック　3級",
          "code": "ct704"
        },
        {
          "id": 4,
          "name": "メドック　4級",
          "code": "ct705"
        },
        {
          "id": 5,
          "name": "メドック　5級",
          "code": "ct706"
        },
        {
          "id": 6,
          "name": "2nd ワイン",
          "code": "ct934"
        }
      ]
    },
    {
      "id": 3,
      "name": "ブルゴーニュ",
      "code": "ct701",
      "child": true,
      "array_child": [
        {
          "id": 1,
          "name": "特級",
          "code": "ct707"
        },
        {
          "id": 2,
          "name": "1級",
          "code": "ct708"
        }
      ]
    },
    {
      "id": 4,
      "name": "シャンパーニュ",
      "code": "ct935",
      "child": true,
      "array_child": [
        {
          "id": 1,
          "name": "特級",
          "code": "ct937"
        },
        {
          "id": 2,
          "name": "1級",
          "code": "ct938"
        }
      ]
    }
  ];
  return _data;
}
function listSearch() {
  const _data = {
    "categories": getCategories(),
    "origin": getOrigin(),
    "size": getSize(),
    'type': getType(),
    'body': getBody(),
    "vintage": getVintage(),
    "ranker": getRanker()
  }
  return _data;
}
function allOrigin(checked) {
  let new_Origin = [];
  if (!checked) {
    return new_Origin;
  }
  const _all_origin = getOrigin();
  _all_origin.forEach(parent => {
    new_Origin.push(parent.code);
    if (parent.child) {
      let child = parent.array_child;
      child.forEach(child => {
        new_Origin.push(child.code);
        if (child.child) {
          let child_level = child.array_child;
          child_level.forEach(child_lv => {
            new_Origin.push(child_lv.code);
          });
        }
      });
    }
  });
  return new_Origin;
}
function allBody(checked) {
  let new_Body = [];
  if (!checked) {
    return new_Body;
  }
  const __all_body = getBody();
  __all_body.forEach(item => {
    new_Body.push(item.code);
  });
  return new_Body;
}