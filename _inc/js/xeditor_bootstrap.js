/************************************************************************/
/************************************************************************/
/*********      COPYRIGHT (C) Ruwix Services SRL. 2018      *************/
/************************************************************************/
/************************************************************************/

function GetCookie(e) {
    for (var t = e + _0xc373[5], c = t[_0xc373[6]], x = document[_0xc373[7]][_0xc373[6]], _ = 0; _ < x;) {
        var i = _ + c;
        if (document[_0xc373[7]][_0xc373[8]](_, i) == t) return _0xc373[9];
        if (0 == (_ = document[_0xc373[7]][_0xc373[11]](_0xc373[10], _) + 1)) break
    }
    return null
}

function testFirstCookie() {
    if (null == GetCookie(_0xc373[12])) {
        var e = new Date;
        e = new Date(e[_0xc373[13]]() + 7776e6), document[_0xc373[7]] = _0xc373[14] + e;
        var t = _0xc373[15];
        sourceEditorFricc[_0xc373[16]](t), inputChanged()
    }
}

function startFirstTour() {
    beforeDemoText = sourceEditorFricc[_0xc373[17]]();
    var e = _0xc373[15];
    sourceEditorFricc[_0xc373[16]](e), inputChanged(), demoElinditva = 1, updateRight()
}

function createCookie(e, t, c) {
    var x;
    if (c) {
        var _ = new Date;
        _[_0xc373[18]](_[_0xc373[13]]() + 24 * c * 60 * 60 * 1e3), x = _0xc373[19] + _[_0xc373[20]]()
    } else x = _0xc373[1];
    document[_0xc373[7]] = encodeURIComponent(e) + _0xc373[5] + encodeURIComponent(t) + x + _0xc373[21]
}

function readCookie(e) {
    for (var t = encodeURIComponent(e) + _0xc373[5], c = document[_0xc373[7]][_0xc373[23]](_0xc373[22]), x = 0; x < c[_0xc373[6]]; x++) {
        for (var _ = c[x]; _[_0xc373[24]](0) === _0xc373[10];) _ = _[_0xc373[8]](1, _[_0xc373[6]]);
        if (0 === _[_0xc373[11]](t)) return decodeURIComponent(_[_0xc373[8]](t[_0xc373[6]], _[_0xc373[6]]))
    }
    return null
}

function eraseCookie(e) {
    createCookie(e, _0xc373[1], -1)
}

function popupBox(e) {
    document[_0xc373[27]](_0xc373[26])[_0xc373[25]] = e, document[_0xc373[27]](_0xc373[30])[_0xc373[29]][_0xc373[28]] = _0xc373[31]
}

function undoPressed() {
    text = sourceEditorFricc[_0xc373[17]](), sourceEditorFricc[_0xc373[16]](undotext), undotext = text, inputChanged()
}

function updateRight() {
    sourceEditorFricc[_0xc373[16]](tinymce[_0xc373[34]](_0xc373[33])[_0xc373[32]]())
}

function updateLeft() {
    0 == wysiwygActive && tinyMCE[_0xc373[36]][_0xc373[35]](sourceEditorFricc[_0xc373[17]]())
}

function inputChanged() {
    document[_0xc373[27]](_0xc373[37])[_0xc373[25]] = _0xc373[38] + sourceEditorFricc[_0xc373[17]]()[_0xc373[6]], updateLeft()
}

function deletePressed() {
    undotext = sourceEditorFricc[_0xc373[17]](), sourceEditorFricc[_0xc373[16]](_0xc373[1]), inputChanged()
}

function actualizeReplaceket() {
    for (var e = 1; e <= 12; e++) 1 == replaceaktiv[e] ? document[_0xc373[27]](_0xc373[39] + e)[_0xc373[29]][_0xc373[28]] = _0xc373[31] : document[_0xc373[27]](_0xc373[39] + e)[_0xc373[29]][_0xc373[28]] = _0xc373[40]
}

function addRepField() {
    for (var e = 0, t = 1; 0 == e && t <= 12;) 0 == replaceaktiv[t] && (replaceaktiv[t] = 1, e = 1), t++;
    0 == e && popupBox(_0xc373[41]), actualizeReplaceket()
}

function deleteRepField(e) {
    1 == e && (replacetext1[_0xc373[42]] = _0xc373[1], replacewith1[_0xc373[42]] = _0xc373[1]), 2 == e && (replacetext2[_0xc373[42]] = _0xc373[1], replacewith2[_0xc373[42]] = _0xc373[1]), 3 == e && (replacetext3[_0xc373[42]] = _0xc373[1], replacewith3[_0xc373[42]] = _0xc373[1]), 4 == e && (replacetext4[_0xc373[42]] = _0xc373[1], replacewith4[_0xc373[42]] = _0xc373[1]), 5 == e && (replacetext5[_0xc373[42]] = _0xc373[1], replacewith5[_0xc373[42]] = _0xc373[1]), 6 == e && (replacetext6[_0xc373[42]] = _0xc373[1], replacewith6[_0xc373[42]] = _0xc373[1]), 7 == e && (replacetext7[_0xc373[42]] = _0xc373[1], replacewith7[_0xc373[42]] = _0xc373[1]), 8 == e && (replacetext8[_0xc373[42]] = _0xc373[1], replacewith8[_0xc373[42]] = _0xc373[1]), 9 == e && (replacetext9[_0xc373[42]] = _0xc373[1], replacewith9[_0xc373[42]] = _0xc373[1]), 10 == e && (replacetext10[_0xc373[42]] = _0xc373[1], replacewith10[_0xc373[42]] = _0xc373[1]), 11 == e && (replacetext11[_0xc373[42]] = _0xc373[1], replacewith11[_0xc373[42]] = _0xc373[1]), 12 == e && (replacetext12[_0xc373[42]] = _0xc373[1], replacewith12[_0xc373[42]] = _0xc373[1]), replaceaktiv[e] = 0, actualizeReplaceket()
}

function initoptions2() {
    tinymce[_0xc373[77]]({
        selector: _0xc373[43],

        plugins: 'codesample code',
        codesample_languages: [
            { text: 'HTML/XML', value: 'markup' },
            { text: 'JavaScript', value: 'javascript' },
            { text: 'CSS', value: 'css' },
            { text: 'PHP', value: 'php' },
            { text: 'Ruby', value: 'ruby' },
            { text: 'Python', value: 'python' },
            { text: 'Java', value: 'java' },
            { text: 'C', value: 'c' },
            { text: 'C#', value: 'csharp' },
            { text: 'C++', value: 'cpp' }
        ],
        toolbar: 'codesample code'
    });

    for (var j = 1; j < 86; j++) {
        console.log("_0xc373[" + j + "]=" + _0xc373[j]);
    }


}
//	 valid_elements : 'div[*],section[*],span[*],a[*],ul[*],li[*],html[*],blockquote[*],p[*],nav[*],table[*],meta[*],head[*],title[*],link[*],script[*],body[*],footer[*],header[*],b,u,style[*]',
function initp(rr) {
    //alert(rr);
    tinymce.init({
        plugins: [
            'kk' + rr
        ]

    });
}
function initoptions() {
    //alert(_0xc373[77]);
    tinymce[_0xc373[77]]({
        selector: _0xc373[43],
        theme: _0xc373[44],
        element_format: 'html',
        extended_valid_elements: 'span[*]',
        content_css: '/codem/bootstrap.min.css',
        convert_urls: !1,
        allow_unsafe_link_target: true,
        entity_encoding: 'named',
        plugins: ['advlist autolink link image lists charmap print preview hr anchor', 'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking', 'table directionality emoticons paste textcolor'],
        add_unload_trigger: !1,
        toolbar: ' code | styleselect fontselect fontsizeselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | preview media fullpage | forecolor backcolor emoticons',
        image_advtab: !0,
        style_formats: [{
            title: 'Heading 1',
            format: 'h1'
        }, {
            title: _0xc373[52],
            format: _0xc373[53]
        }, {
            title: _0xc373[54],
            format: _0xc373[55]
        }, {
            title: _0xc373[56],
            format: _0xc373[57]
        }, {
            title: _0xc373[58],
            format: _0xc373[59]
        }, {
            title: _0xc373[60],
            format: _0xc373[61]
        }, {
            title: _0xc373[62],
            inline: _0xc373[63],
            styles: {
                color: _0xc373[64]
            }
        }, {
            title: _0xc373[65],
            block: _0xc373[63],
            styles: {
                color: _0xc373[66]
            }
        }, {
            title: _0xc373[67],
            block: _0xc373[63],
            styles: {
                color: _0xc373[68]
            }
        }],
        height: 500,

    });

}

function initoptionm() {
    //alert(_0xc373[77]);
    tinymce[_0xc373[77]]({
        selector: _0xc373[43],
        theme: _0xc373[44],
        element_format: 'html',
        extended_valid_elements: 'span[*]',
        content_css: '/codem/bootstrap.min.css',
        convert_urls: !1,
        allow_unsafe_link_target: true,
        entity_encoding: 'named',
        plugins: ['advlist autolink link image lists charmap print preview hr anchor', 'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking', 'table directionality emoticons paste textcolor'],
        add_unload_trigger: !1,
        menubar: false,
        toolbar: ' code | styleselect  | bold italic underline ',
        image_advtab: !0,
        style_formats: [{
            title: 'Heading 1',
            format: 'h1'
        }, {
            title: _0xc373[52],
            format: _0xc373[53]
        }, {
            title: _0xc373[54],
            format: _0xc373[55]
        }, {
            title: _0xc373[56],
            format: _0xc373[57]
        }, {
            title: _0xc373[58],
            format: _0xc373[59]
        }, {
            title: _0xc373[60],
            format: _0xc373[61]
        }, {
            title: _0xc373[62],
            inline: _0xc373[63],
            styles: {
                color: _0xc373[64]
            }
        }, {
            title: _0xc373[65],
            block: _0xc373[63],
            styles: {
                color: _0xc373[66]
            }
        }, {
            title: _0xc373[67],
            block: _0xc373[63],
            styles: {
                color: _0xc373[68]
            }
        }],
        height: 200,

    });
    //console.log("height:" + _0xc373[69]);

}

function editortUjraInicializal() {
    1 == opt[16] ? tinymce[_0xc373[77]]({
        selector: _0xc373[43],
        theme: _0xc373[44],
        convert_urls: !1,
        entity_encoding: _0xc373[45],
        plugins: [_0xc373[46], _0xc373[47], _0xc373[48]],
        add_unload_trigger: !1,
        toolbar: _0xc373[49],
        image_advtab: !0,
        style_formats: [{
            title: _0xc373[50],
            format: _0xc373[51]
        }, {
            title: _0xc373[52],
            format: _0xc373[53]
        }, {
            title: _0xc373[54],
            format: _0xc373[55]
        }, {
            title: _0xc373[56],
            format: _0xc373[57]
        }, {
            title: _0xc373[58],
            format: _0xc373[59]
        }, {
            title: _0xc373[60],
            format: _0xc373[61]
        }, {
            title: _0xc373[62],
            inline: _0xc373[63],
            styles: {
                color: _0xc373[64]
            }
        }, {
            title: _0xc373[65],
            block: _0xc373[63],
            styles: {
                color: _0xc373[66]
            }
        }, {
            title: _0xc373[67],
            block: _0xc373[63],
            styles: {
                color: _0xc373[68]
            }
        }],
        height: _0xc373[69],
        setup: function (e) {
            e[_0xc373[71]](_0xc373[70], function (e) {
                updateRight()
            }), e[_0xc373[71]](_0xc373[72], function (e) {
                updateRight()
            }), e[_0xc373[71]](_0xc373[73], function (e) {
                updateRight()
            }), e[_0xc373[71]](_0xc373[74], function (e) {
                updateRight()
            }), e[_0xc373[71]](_0xc373[75], function (e) {
                wysiwygActive = 1
            }), e[_0xc373[71]](_0xc373[76], function (e) {
                wysiwygActive = 0
            })
        }
    }) : tinymce[_0xc373[77]]({
        selector: _0xc373[43],
        theme: _0xc373[44],
        convert_urls: !1,
        entity_encoding: _0xc373[86],
        plugins: [_0xc373[46], _0xc373[47], _0xc373[48]],
        add_unload_trigger: !1,
        toolbar: _0xc373[49],
        image_advtab: !0,
        style_formats: [{
            title: _0xc373[50],
            format: _0xc373[51]
        }, {
            title: _0xc373[52],
            format: _0xc373[53]
        }, {
            title: _0xc373[54],
            format: _0xc373[55]
        }, {
            title: _0xc373[56],
            format: _0xc373[57]
        }, {
            title: _0xc373[58],
            format: _0xc373[59]
        }, {
            title: _0xc373[60],
            format: _0xc373[61]
        }, {
            title: _0xc373[62],
            inline: _0xc373[63],
            styles: {
                color: _0xc373[64]
            }
        }, {
            title: _0xc373[65],
            block: _0xc373[63],
            styles: {
                color: _0xc373[66]
            }
        }, {
            title: _0xc373[67],
            block: _0xc373[63],
            styles: {
                color: _0xc373[68]
            }
        }],
        height: _0xc373[69],
        setup: function (e) {
            e[_0xc373[71]](_0xc373[70], function (e) {
                updateRight()
            }), e[_0xc373[71]](_0xc373[72], function (e) {
                updateRight()
            }), e[_0xc373[71]](_0xc373[73], function (e) {
                updateRight()
            }), e[_0xc373[71]](_0xc373[74], function (e) {
                updateRight()
            }), e[_0xc373[71]](_0xc373[75], function (e) {
                wysiwygActive = 1
            }), e[_0xc373[71]](_0xc373[76], function (e) {
                wysiwygActive = 0
            })
        }
    }), 1 == useBootstrp && tinyMCE[_0xc373[36]][_0xc373[89]][_0xc373[88]](_0xc373[87])
}

function clickedOption(e) {
    if (0 == opt[e] ? opt[e] = 1 : opt[e] = 0, 0 == e)
        for (t = 1; t < hanyoption; t++) opt[t] = opt[0];
    for (var t = 0; t < hanyoption; t++) 0 == opt[t] ? document[_0xc373[27]](_0xc373[80] + t)[_0xc373[29]][_0xc373[79]] = _0xc373[81] : document[_0xc373[27]](_0xc373[80] + t)[_0xc373[29]][_0xc373[79]] = _0xc373[82];
    for (t = 1; t < hanyoption; t++) createCookie(_0xc373[78] + t, opt[t], 30);
    16 != e && 0 != e || (tinyMCE[_0xc373[36]][_0xc373[85]](), editortUjraInicializal(), updateLeft(), updateRight())
}

function setDefaultOptions() {
    (opt = [0, 1, 1, 1, 1, 0, 1, 0, 0, 0, 1, 0, 0, 1, 0, 0, 0, 1, 0, 0, 0])[1] = 1, opt[2] = 1, opt[3] = 1, opt[4] = 1, opt[16] = 1, opt[6] = 1, opt[10] = 1, opt[13] = 1;
    for (var e = 0; e < hanyoption; e++) 0 == opt[e] ? document[_0xc373[27]](_0xc373[80] + e)[_0xc373[29]][_0xc373[79]] = _0xc373[81] : document[_0xc373[27]](_0xc373[80] + e)[_0xc373[29]][_0xc373[79]] = _0xc373[82];
    for (e = 1; e < hanyoption; e++) createCookie(_0xc373[78] + e, opt[e], 30);
    tinyMCE[_0xc373[36]][_0xc373[85]](), editortUjraInicializal(), updateLeft(), updateRight()
}

function removeTagAttributes() {
    hossz = text[_0xc373[6]];
    for (var e = text[_0xc373[23]](_0xc373[1]), t = new Array(_0xc373[1]), c = 1, x = 0, _ = 0; x < hossz;) e[x] == _0xc373[90] && (c = 2, e[x + 1] == _0xc373[91] && e[x + 2] == _0xc373[92] && e[x + 3] == _0xc373[92] && (c = 1), e[x + 1] == _0xc373[93] && e[x + 2] == _0xc373[10] && (c = 4), e[x + 1] == _0xc373[94] && e[x + 2] == _0xc373[95] && e[x + 3] == _0xc373[96] && e[x + 4] == _0xc373[10] && (c = 14)), e[x] == _0xc373[10] && (2 == c && (c = 3), 4 != c && 5 != c || (e[x + 1] == _0xc373[97] && e[x + 2] == _0xc373[98] && e[x + 3] == _0xc373[99] && e[x + 4] == _0xc373[100] && (c = 6), e[x + 1] == _0xc373[101] && e[x + 2] == _0xc373[102] && e[x + 3] == _0xc373[103] && e[x + 4] == _0xc373[104] && e[x + 5] == _0xc373[105] && e[x + 6] == _0xc373[102] && e[x + 7] == _0xc373[93] && e[x + 8] == _0xc373[101] && (c = 6)), 14 != c && 15 != c || e[x + 1] == _0xc373[106] && e[x + 2] == _0xc373[98] && e[x + 3] == _0xc373[107] && (c = 16), 4 == c && (c = 5), 8 == c && (c = 3), 14 == c && (c = 15), 18 == c && (c = 3)), e[x] == _0xc373[108] && c == _0xc373[109] && (c = 8), e[x] == _0xc373[108] && c == _0xc373[110] && (c = 7), e[x] == _0xc373[108] && c == _0xc373[111] && (c = 18), e[x] == _0xc373[108] && c == _0xc373[112] && (c = 17), (e[x] == _0xc373[113] || e[x] == _0xc373[114] && e[x + 1] == _0xc373[113]) && (c = 1), 1 != c && 2 != c && 4 != c && 6 != c && 7 != c && 8 != c && 14 != c && 16 != c && 17 != c && 18 != c || (t[_] = e[x], _++), x++;
    text = t[_0xc373[115]](_0xc373[1])
}

function uresTagotTorul() {
    hossz = text[_0xc373[6]];
    for (var e = text[_0xc373[23]](_0xc373[1]), t = new Array(_0xc373[1]), c = 0, x = 0, _ = 0, i = 0, o = 0; c < hossz;) {
        if (0 == _ && e[c] == _0xc373[90] && e[c + 1] != _0xc373[114] && (_ = 1, i = c), 2 == _ && e[c] == _0xc373[113]) {
            for (o = 0; o <= c - i; o++) t[o + i] = _0xc373[1];
            e[c] = _0xc373[1], _ = 0
        }
        1 == _ && e[c] == _0xc373[113] && (_ = e[c - 2] != _0xc373[114] && e[c - 1] != _0xc373[114] && e[c + 1] == _0xc373[90] && e[c + 2] == _0xc373[114] ? 2 : 0), t[x] = e[c], x++ , c++
    }
    text = t[_0xc373[115]](_0xc373[1])
}

function csakEnteresTagotTorul() {
    hossz = text[_0xc373[6]];
    for (var e = text[_0xc373[23]](_0xc373[1]), t = new Array(_0xc373[1]), c = 0, x = 0, _ = 0, i = 0, o = 0; c < hossz;) {
        if (0 == _ && e[c] == _0xc373[90] && e[c + 1] != _0xc373[114] && (_ = 1, i = c), 2 == _ && e[c] == _0xc373[113]) {
            for (o = 0; o <= c - i; o++) t[o + i] = _0xc373[1];
            e[c] = _0xc373[1], _ = 0
        }
        1 == _ && e[c] == _0xc373[113] && (_ = e[c - 2] != _0xc373[114] && e[c - 1] != _0xc373[114] && e[c + 1] == _0xc373[116] && e[c + 2] == _0xc373[90] && e[c + 3] == _0xc373[114] ? 2 : 0), t[x] = e[c], x++ , c++
    }
    text = t[_0xc373[115]](_0xc373[1])
}

function csakEgyNbspTagotTorul() {
    hossz = text[_0xc373[6]];
    for (var e = text[_0xc373[23]](_0xc373[1]), t = new Array(_0xc373[1]), c = 0, x = 0, _ = 0, i = 0, o = 0; c < hossz;) {
        if (0 == _ && e[c] == _0xc373[90] && e[c + 1] != _0xc373[114] && (_ = 1, i = c), 2 == _ && e[c] == _0xc373[113]) {
            for (o = 0; o <= c - i; o++) t[o + i] = _0xc373[1];
            e[c] = _0xc373[1], _ = 0
        }
        1 == _ && e[c] == _0xc373[113] && (_ = e[c - 2] != _0xc373[114] && e[c - 1] != _0xc373[114] && e[c + 1] == _0xc373[117] && e[c + 2] == _0xc373[104] && e[c + 3] == _0xc373[118] && e[c + 4] == _0xc373[106] && e[c + 5] == _0xc373[59] && e[c + 6] == _0xc373[22] && e[c + 7] == _0xc373[90] && e[c + 8] == _0xc373[114] ? 2 : 0), t[x] = e[c], x++ , c++
    }
    text = t[_0xc373[115]](_0xc373[1])
}

function torolTagbanKettoKozt(e, t) {
    hossz = text[_0xc373[6]];
    for (var c = e[_0xc373[6]], x = t[_0xc373[6]], _ = text[_0xc373[23]](_0xc373[1]), i = e[_0xc373[23]](_0xc373[1]), o = t[_0xc373[23]](_0xc373[1]), a = 0, n = new Array(_0xc373[1]), r = 1, s = 0, l = 0, u = 0, p = 0, d = 0; s < hossz;) {
        if (_[s] == _0xc373[90] && (a = 1), _[s] == _0xc373[113] && (a = 0), 1 == a) {
            for (p = 1, u = 0; u < c; u++) i[u] != _[s + u] && (p = 0);
            if (1 == p)
                for (d++ , r = -999, s += c, u = 0; u < c; u++) n[l] = i[u], l++
        }
        for (p = 1, u = 0; u < x; u++) o[u] != _[s + u] && (p = 0);
        1 == p && (r = 0), -999 != r && r++ , r > 0 && (n[l] = _[s], l++), s++
    }
    return text = n[_0xc373[115]](_0xc373[1]), d
}

function tTKKInclusive(e, t) {
    torolTagbanKettoKozt(e, t), helyettesit(_0xc373[119], _0xc373[1])
}

function removeStilust() {
    hossz = text[_0xc373[6]];
    for (var e = text[_0xc373[23]](_0xc373[1]), t = new Array(_0xc373[1]), c = 1, x = 0, _ = 0; x < hossz;) e[x] == _0xc373[106] && e[x + 1] == _0xc373[120] && e[x + 2] == _0xc373[121] && e[x + 3] == _0xc373[105] && e[x + 4] == _0xc373[99] && e[x + 5] == _0xc373[5] && e[x + 6] == _0xc373[108] && (c = -999, x += 6), -999 == c && e[x + 1] == _0xc373[108] && (c = -2), -999 != c && c++ , c > 0 && (t[_] = e[x], _++), x++;
    text = t[_0xc373[115]](_0xc373[1])
}

function helyettesit(e, t) {
    var c = text,
        x = 0,
        _ = 0;
    do {
        x = 0, (c = text[_0xc373[39]](e, t)) == text ? x = 1 : _++ , text = c
    } while (0 == x);
    return _
}

function bekezdeseketRendez() {
    var e = 0;
    hossz = text[_0xc373[6]];
    for (var t = text[_0xc373[23]](_0xc373[1]), c = new Array(_0xc373[1]), x = 0, _ = 0, i = 0, o = 1, a = 0; x < hossz;) {
        if (t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[91] && t[x - 3] == _0xc373[122] && t[x - 2] == _0xc373[123] && t[x - 1] == _0xc373[124] && t[x] == _0xc373[125] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[91] && t[x - 3] == _0xc373[101] && t[x - 2] == _0xc373[102] && t[x - 1] == _0xc373[107] && t[x] == _0xc373[120] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[126] && t[x - 3] == _0xc373[127] && t[x - 2] == _0xc373[128] && t[x - 1] == _0xc373[129] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[105] && t[x - 3] == _0xc373[94] && t[x - 2] == _0xc373[104] && t[x - 1] == _0xc373[130] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[131] && t[x - 3] == _0xc373[132] && t[x - 2] == _0xc373[125] && t[x - 1] == _0xc373[133] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[95] && t[x - 3] == _0xc373[99] && t[x - 2] == _0xc373[120] && t[x - 1] == _0xc373[93] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[134] && t[x - 3] == _0xc373[133] && t[x - 2] == _0xc373[135] && t[x - 1] == _0xc373[132] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[118] && t[x - 3] == _0xc373[93] && t[x - 2] == _0xc373[106] && t[x - 1] == _0xc373[99] && (a = 1), t[x - 2] == _0xc373[90] && t[x - 1] == _0xc373[134] && t[x] == _0xc373[136] && (a = 1), t[x - 2] == _0xc373[90] && t[x - 1] == _0xc373[118] && t[x] == _0xc373[98] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[107] && t[x - 3] == _0xc373[102] && t[x - 2] == _0xc373[105] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[124] && t[x - 3] == _0xc373[123] && t[x - 2] == _0xc373[126] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[107] && t[x - 3] == _0xc373[102] && t[x - 2] == _0xc373[95] && t[x - 1] == _0xc373[95] && t[x] == _0xc373[93] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[99] && t[x - 3] == _0xc373[95] && t[x - 2] == _0xc373[118] && t[x - 1] == _0xc373[99] && (a = 1), t[x - 2] == _0xc373[90] && t[x - 1] == _0xc373[137] && t[x] == _0xc373[136] && (a = 1), t[x - 2] == _0xc373[90] && t[x - 1] == _0xc373[97] && t[x] == _0xc373[98] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[127] && t[x - 3] == _0xc373[131] && t[x - 2] == _0xc373[138] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[94] && t[x - 3] == _0xc373[95] && t[x - 2] == _0xc373[96] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[94] && t[x - 3] == _0xc373[104] && t[x - 2] == _0xc373[59] && t[x - 1] == _0xc373[139] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[59] && t[x - 3] == _0xc373[93] && t[x - 2] == _0xc373[98] && t[x - 1] == _0xc373[93] && (a = 1), t[x - 5] == _0xc373[90] && t[x - 4] == _0xc373[106] && t[x - 3] == _0xc373[102] && t[x - 2] == _0xc373[139] && t[x - 1] == _0xc373[98] && (a = 1), t[x] == _0xc373[90] && t[x + 1] == _0xc373[106] && t[x + 2] == _0xc373[107] && t[x + 3] == _0xc373[98] && t[x + 4] == _0xc373[94] && t[x + 5] == _0xc373[59] && t[x + 6] == _0xc373[120])
            for (; t[x - 8] != _0xc373[114] || t[x - 7] != _0xc373[106] || t[x - 6] != _0xc373[107] || t[x - 5] != _0xc373[98] || t[x - 4] != _0xc373[94] || t[x - 3] != _0xc373[59] || t[x - 2] != _0xc373[120] || t[x - 1] != _0xc373[113];) c[_] = t[x], _++ , x++;
        if (t[x] == _0xc373[90] && t[x + 1] == _0xc373[106] && t[x + 2] == _0xc373[120] && t[x + 3] == _0xc373[121] && t[x + 4] == _0xc373[105] && t[x + 5] == _0xc373[99])
            for (; t[x - 8] != _0xc373[90] || t[x - 7] != _0xc373[114] || t[x - 6] != _0xc373[106] || t[x - 5] != _0xc373[120] || t[x - 4] != _0xc373[121] || t[x - 3] != _0xc373[105] || t[x - 2] != _0xc373[99] || t[x - 1] != _0xc373[113];) c[_] = t[x], _++ , x++;
        if (t[x - 3] == _0xc373[90] && t[x - 2] == _0xc373[91] && t[x - 1] == _0xc373[92] && t[x] == _0xc373[92] && 1, t[x - 3] == _0xc373[92] && t[x - 2] == _0xc373[92] && t[x - 1] == _0xc373[113] && 0, o = 1, t[x] == _0xc373[90] && t[x + 1] != _0xc373[91])
            if (t[x + 1] == _0xc373[114]) {
                for (e-- , c[_] = _0xc373[116], _++ , i = 0; i < e; i++) c[_] = _0xc373[140], _++;
                e--
            } else
                for (c[_] = _0xc373[116], _++ , i = 0; i < e; i++) c[_] = _0xc373[140], _++;
        if (t[x] == _0xc373[113] && t[x - 1] != _0xc373[92] && t[x - 1] != _0xc373[141])
            if (t[x - 1] == _0xc373[114])
                for (o = 0, a = 0, c[_] = _0xc373[113], c[_ + 1] = _0xc373[116], _ += 2, i = 0; i < e; i++) c[_] = _0xc373[140], _++;
            else
                for (o = 0, 0 == a && e++ , a = 0, c[_] = _0xc373[113], c[_ + 1] = _0xc373[116], _ += 2, i = 0; i < e; i++) c[_] = _0xc373[140], _++;
        1 == o && (c[_] = t[x], _++), x++
    }
    if (c[0] == _0xc373[116]) {
        for (x = 0; x < _; x++) c[x] = c[x + 1];
        c[x + 1] = _0xc373[1]
    }
    text = c[_0xc373[115]](_0xc373[1])
}

function convertText() {
    undotext = tinymce[_0xc373[34]](_0xc373[33])[_0xc373[32]](), text = undotext;
    var e = 0;
    helyettesit(_0xc373[140], _0xc373[1]), helyettesit(_0xc373[142], _0xc373[10]), helyettesit(_0xc373[143], _0xc373[116]), helyettesit(_0xc373[144], _0xc373[116]), helyettesit(_0xc373[145], _0xc373[116]), helyettesit(_0xc373[142], _0xc373[10]);
    var t = 0,
        c = 0;
    torolTagbanKettoKozt(_0xc373[146], _0xc373[147]), torolTagbanKettoKozt(_0xc373[148], _0xc373[149]), helyettesit(_0xc373[150], _0xc373[1]) > 0 && t++ , helyettesit(_0xc373[151], _0xc373[1]) > 0 && c++ , 0 != t && 0 == c && popupBox(_0xc373[152]), 0 != t && 0 != c && popupBox(_0xc373[153]), 0 == t && 0 != c && popupBox(_0xc373[154]), 1 == opt[12] && (helyettesit(_0xc373[155], _0xc373[156]), torolTagbanKettoKozt(_0xc373[90], _0xc373[113]), helyettesit(_0xc373[157], _0xc373[10]), helyettesit(_0xc373[156], _0xc373[155])), 1 == opt[1] && (helyettesit(_0xc373[158], _0xc373[159]), helyettesit(_0xc373[160], _0xc373[159]), helyettesit(_0xc373[161], _0xc373[159]), torolTagbanKettoKozt(_0xc373[162], _0xc373[108]), helyettesit(_0xc373[163], _0xc373[1]), helyettesit(_0xc373[164], _0xc373[165]), helyettesit(_0xc373[166], _0xc373[165]), helyettesit(_0xc373[167], _0xc373[165]), torolTagbanKettoKozt(_0xc373[168], _0xc373[108]), helyettesit(_0xc373[169], _0xc373[1]), helyettesit(_0xc373[170], _0xc373[171]), helyettesit(_0xc373[172], _0xc373[171]), helyettesit(_0xc373[173], _0xc373[171]), torolTagbanKettoKozt(_0xc373[174], _0xc373[108]), helyettesit(_0xc373[175], _0xc373[1])), 1 == opt[2] && (helyettesit(_0xc373[176], _0xc373[10]), helyettesit(_0xc373[177], _0xc373[10]), helyettesit(_0xc373[178], _0xc373[10])), 1 == opt[3] && (helyettesit(_0xc373[179], _0xc373[180]), helyettesit(_0xc373[181], _0xc373[180]), helyettesit(_0xc373[182], _0xc373[180]), torolTagbanKettoKozt(_0xc373[183], _0xc373[108]), helyettesit(_0xc373[184], _0xc373[1]), helyettesit(_0xc373[185], _0xc373[186]), helyettesit(_0xc373[187], _0xc373[186]), helyettesit(_0xc373[188], _0xc373[186]), torolTagbanKettoKozt(_0xc373[189], _0xc373[108]), helyettesit(_0xc373[190], _0xc373[1])), 1 == opt[4] && (torolTagbanKettoKozt(_0xc373[191], _0xc373[113]), torolTagbanKettoKozt(_0xc373[192], _0xc373[113]), helyettesit(_0xc373[193], _0xc373[194]), helyettesit(_0xc373[195], _0xc373[194]), helyettesit(_0xc373[196], _0xc373[197]), helyettesit(_0xc373[198], _0xc373[199]), helyettesit(_0xc373[200], _0xc373[199]), helyettesit(_0xc373[201], _0xc373[202])), 1 == opt[7] && (torolTagbanKettoKozt(_0xc373[203], _0xc373[113]), torolTagbanKettoKozt(_0xc373[204], _0xc373[113]), torolTagbanKettoKozt(_0xc373[205], _0xc373[113]), torolTagbanKettoKozt(_0xc373[206], _0xc373[113]), torolTagbanKettoKozt(_0xc373[207], _0xc373[113]), torolTagbanKettoKozt(_0xc373[208], _0xc373[113]), torolTagbanKettoKozt(_0xc373[209], _0xc373[113]), helyettesit(_0xc373[210], _0xc373[1]), helyettesit(_0xc373[211], _0xc373[1]), helyettesit(_0xc373[212], _0xc373[1]), helyettesit(_0xc373[213], _0xc373[1]), helyettesit(_0xc373[214], _0xc373[1]), helyettesit(_0xc373[215], _0xc373[1]), helyettesit(_0xc373[216], _0xc373[1]), helyettesit(_0xc373[217], _0xc373[1]), helyettesit(_0xc373[218], _0xc373[1]), helyettesit(_0xc373[219], _0xc373[1]), helyettesit(_0xc373[220], _0xc373[1]), helyettesit(_0xc373[221], _0xc373[1]), helyettesit(_0xc373[222], _0xc373[1]), helyettesit(_0xc373[223], _0xc373[1])), 1 == opt[8] && (torolTagbanKettoKozt(_0xc373[203], _0xc373[113]), torolTagbanKettoKozt(_0xc373[204], _0xc373[113]), helyettesit(_0xc373[211], _0xc373[224]), torolTagbanKettoKozt(_0xc373[205], _0xc373[113]), torolTagbanKettoKozt(_0xc373[206], _0xc373[113]), torolTagbanKettoKozt(_0xc373[207], _0xc373[113]), torolTagbanKettoKozt(_0xc373[208], _0xc373[113]), torolTagbanKettoKozt(_0xc373[209], _0xc373[113]), helyettesit(_0xc373[210], _0xc373[225]), helyettesit(_0xc373[213], _0xc373[226]), helyettesit(_0xc373[212], _0xc373[227]), helyettesit(_0xc373[214], _0xc373[228]), helyettesit(_0xc373[215], _0xc373[229]), helyettesit(_0xc373[216], _0xc373[230]), helyettesit(_0xc373[217], _0xc373[231]), helyettesit(_0xc373[220], _0xc373[231]), helyettesit(_0xc373[218], _0xc373[231]), helyettesit(_0xc373[219], _0xc373[231]), helyettesit(_0xc373[221], _0xc373[231]), helyettesit(_0xc373[222], _0xc373[231]), helyettesit(_0xc373[223], _0xc373[231])), 1 == opt[9] && (torolTagbanKettoKozt(_0xc373[232], _0xc373[113]), helyettesit(_0xc373[233], _0xc373[1]), helyettesit(_0xc373[234], _0xc373[1]), helyettesit(_0xc373[235], _0xc373[1])), 1 == opt[10] && (torolTagbanKettoKozt(_0xc373[236], _0xc373[113]), helyettesit(_0xc373[237], _0xc373[1]), helyettesit(_0xc373[238], _0xc373[1]), helyettesit(_0xc373[239], _0xc373[1])), 1 == opt[11] && (torolTagbanKettoKozt(_0xc373[240], _0xc373[113]), helyettesit(_0xc373[241], _0xc373[1]), helyettesit(_0xc373[242], _0xc373[1]), helyettesit(_0xc373[243], _0xc373[1])), 1 == opt[13] && (torolTagbanKettoKozt(_0xc373[155], _0xc373[244]), helyettesit(_0xc373[245], _0xc373[1])), 1 == opt[6] && (helyettesit(_0xc373[246], _0xc373[247]), helyettesit(_0xc373[248], _0xc373[247]), csakEgyNbspTagotTorul()), 1 == opt[5] && (helyettesit(_0xc373[249], _0xc373[250]), helyettesit(_0xc373[251], _0xc373[252]), uresTagotTorul(), csakEnteresTagotTorul());
    do {
        e = 0, e += helyettesit(_0xc373[142], _0xc373[10]), e += helyettesit(_0xc373[253], _0xc373[113]), e += helyettesit(_0xc373[140], _0xc373[1]), e += helyettesit(_0xc373[142], _0xc373[10]), e += helyettesit(_0xc373[254], _0xc373[116]), e += helyettesit(_0xc373[143], _0xc373[116]), e += helyettesit(_0xc373[145], _0xc373[116]), 1 == opt[14] && (e += helyettesit(_0xc373[116], _0xc373[1]))
    } while (e > 0);
    1 == opt[15] && removeTagAttributes(), 1 == opt[14] && (bekezdeseketRendez(), helyettesit(_0xc373[143], _0xc373[116]), helyettesit(_0xc373[144], _0xc373[116]), helyettesit(_0xc373[145], _0xc373[116]), helyettesit(_0xc373[142], _0xc373[10])), helyettesit(_0xc373[143], _0xc373[116]), helyettesit(_0xc373[144], _0xc373[116]), helyettesit(_0xc373[145], _0xc373[116]), helyettesit(_0xc373[142], _0xc373[10]), -1 == String(document[_0xc373[256]])[_0xc373[11]](_0xc373[255]) && (text = _0xc373[10]), document[_0xc373[27]](_0xc373[257])[_0xc373[29]][_0xc373[79]] = _0xc373[258], document[_0xc373[260]][_0xc373[29]][_0xc373[259]] = _0xc373[261], sourceEditorFricc[_0xc373[16]](text), tinyMCE[_0xc373[36]][_0xc373[35]](text), document[_0xc373[27]](_0xc373[37])[_0xc373[25]] = _0xc373[38] + text[_0xc373[6]], $(_0xc373[263])[_0xc373[262]](300)
}

function findandreplacenow() {
    undotext = tinymce[_0xc373[34]](_0xc373[33])[_0xc373[32]](), text = undotext, replaceaktiv[1] && replacetext1[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext1[_0xc373[42]], replacewith1[_0xc373[42]]), replaceaktiv[2] && replacetext2[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext2[_0xc373[42]], replacewith2[_0xc373[42]]), replaceaktiv[3] && replacetext3[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext3[_0xc373[42]], replacewith3[_0xc373[42]]), replaceaktiv[4] && replacetext4[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext4[_0xc373[42]], replacewith4[_0xc373[42]]), replaceaktiv[5] && replacetext5[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext5[_0xc373[42]], replacewith5[_0xc373[42]]), replaceaktiv[6] && replacetext6[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext6[_0xc373[42]], replacewith6[_0xc373[42]]), replaceaktiv[7] && replacetext7[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext7[_0xc373[42]], replacewith7[_0xc373[42]]), replaceaktiv[8] && replacetext8[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext8[_0xc373[42]], replacewith8[_0xc373[42]]), replaceaktiv[9] && replacetext9[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext9[_0xc373[42]], replacewith9[_0xc373[42]]), replaceaktiv[10] && replacetext10[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext10[_0xc373[42]], replacewith10[_0xc373[42]]), replaceaktiv[11] && replacetext11[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext11[_0xc373[42]], replacewith11[_0xc373[42]]), replaceaktiv[12] && replacetext12[_0xc373[42]] != _0xc373[1] && helyettesit(replacetext12[_0xc373[42]], replacewith12[_0xc373[42]]), sourceEditorFricc[_0xc373[16]](text), tinyMCE[_0xc373[36]][_0xc373[35]](text), document[_0xc373[27]](_0xc373[37])[_0xc373[25]] = _0xc373[38] + text[_0xc373[6]], $(_0xc373[264])[_0xc373[262]](200), $(_0xc373[265])[_0xc373[262]](200)
}

function generateLipsum() {
    undotext = sourceEditorFricc[_0xc373[17]]();
    var e = document[_0xc373[267]][_0xc373[266]][_0xc373[42]],
        t = _0xc373[268];
    e > 1 && (t += _0xc373[269]), e > 2 && (t += _0xc373[270]), e > 3 && (t += _0xc373[271]), e > 4 && (t += _0xc373[272]), e > 5 && (t += _0xc373[273]), e > 6 && (t += _0xc373[274]), e > 7 && (t += _0xc373[275]), e > 8 && (t += _0xc373[276]), e > 9 && (t += _0xc373[277]), e > 10 && (t += _0xc373[278]), e > 11 && (t += _0xc373[279]), e > 12 && (t += _0xc373[280]), e > 13 && (t += _0xc373[281]), e > 14 && (t += _0xc373[282]), e > 15 && (t += _0xc373[283]), e > 16 && (t += _0xc373[284]), e > 17 && (t += _0xc373[285]), e > 18 && (t += _0xc373[286]), e > 19 && (t += _0xc373[287]), 1 == document[_0xc373[267]][_0xc373[288]][_0xc373[42]] ? (sourceEditorFricc[_0xc373[16]](undotext + t), tinyMCE[_0xc373[36]][_0xc373[35]](undotext + t), document[_0xc373[27]](_0xc373[37])[_0xc373[25]] = _0xc373[38] + text[_0xc373[6]]) : (document[_0xc373[27]](_0xc373[289])[_0xc373[25]] = t, $(_0xc373[291])[_0xc373[290]](300)), $(_0xc373[264])[_0xc373[262]](200), $(_0xc373[292])[_0xc373[262]](200), $(_0xc373[293])[_0xc373[262]](200), $(_0xc373[294])[_0xc373[262]](200)
}

function popupokatLevesz() {
    $(_0xc373[264])[_0xc373[262]](200), $(_0xc373[295])[_0xc373[262]](200), $(_0xc373[265])[_0xc373[262]](200), $(_0xc373[292])[_0xc373[262]](200), $(_0xc373[293])[_0xc373[262]](200), $(_0xc373[294])[_0xc373[262]](200), document[_0xc373[27]](_0xc373[298])[_0xc373[297]][_0xc373[296]]()
}

function updateColor() {
    selectedColor = document[_0xc373[27]](_0xc373[298])[_0xc373[42]];
    _0xc373[300];
    colr = parseInt((selectedColor[_0xc373[24]](0) + selectedColor[_0xc373[24]](1)).toString(16), 16), colg = parseInt((selectedColor[_0xc373[24]](2) + selectedColor[_0xc373[24]](3)).toString(16), 16), colb = parseInt((selectedColor[_0xc373[24]](4) + selectedColor[_0xc373[24]](5)).toString(16), 16), rgb2cmyk(colr, colg, colb);
    _0xc373[1];
    ovlashato = $(_0xc373[302])[_0xc373[301]](_0xc373[297]), document[_0xc373[27]](_0xc373[303])[_0xc373[25]] = _0xc373[304] + ovlashato + _0xc373[305] + selectedColor + _0xc373[306] + colr + _0xc373[307] + colg + _0xc373[307] + colb + _0xc373[308] + colc + _0xc373[309] + colm + _0xc373[309] + coly + _0xc373[309] + colk + _0xc373[310] + colhue + _0xc373[311] + colsat + _0xc373[312] + colval + _0xc373[313] + selectedColor + _0xc373[314] + ovlashato + _0xc373[315], document[_0xc373[27]](_0xc373[316])[_0xc373[25]] = _0xc373[317] + selectedColor + _0xc373[318] + selectedColor + _0xc373[319], document[_0xc373[27]](_0xc373[303])[_0xc373[29]][_0xc373[320]] = _0xc373[321] + selectedColor, $(_0xc373[324])[_0xc373[301]](_0xc373[322], _0xc373[323] + selectedColor), document[_0xc373[27]](_0xc373[325])[_0xc373[25]] = _0xc373[326] + selectedColor + _0xc373[327] + selectedColor + _0xc373[328] + selectedColor + _0xc373[329] + selectedColor + _0xc373[330] + selectedColor + _0xc373[331] + selectedColor + _0xc373[332] + selectedColor + _0xc373[333]
}

function aplikal(e) {
    document[_0xc373[27]](_0xc373[298])[_0xc373[42]] = e, document[_0xc373[27]](_0xc373[298])[_0xc373[297]][_0xc373[334]](e), updateColor(e)
}

function rgb2cmyk(e, t, c) {
    var x = 0,
        _ = 0,
        i = 0,
        o = 0,
        e = parseInt((_0xc373[1] + e)[_0xc373[39]](/\s/g, _0xc373[1]), 10),
        t = parseInt((_0xc373[1] + t)[_0xc373[39]](/\s/g, _0xc373[1]), 10),
        c = parseInt((_0xc373[1] + c)[_0xc373[39]](/\s/g, _0xc373[1]), 10);
    if (null == e || null == t || null == c || isNaN(e) || isNaN(t) || isNaN(c)) alert(_0xc373[335]);
    else {
        if (!(e < 0 || t < 0 || c < 0 || e > 255 || t > 255 || c > 255)) {
            if (0 == e && 0 == t && 0 == c) return o = 1, [0, 0, 0, 1];
            x = 1 - e / 255, _ = 1 - t / 255, i = 1 - c / 255;
            var a = Math[_0xc373[337]](x, Math[_0xc373[337]](_, i));
            return x = (x - a) / (1 - a), _ = (_ - a) / (1 - a), i = (i - a) / (1 - a), o = a, colc = Math[_0xc373[338]](1e4 * x) / 1e4, colm = Math[_0xc373[338]](1e4 * _) / 1e4, coly = Math[_0xc373[338]](1e4 * i) / 1e4, colk = Math[_0xc373[338]](1e4 * o) / 1e4, [x, _, i, o]
        }
        alert(_0xc373[336])
    }
}

function addtopalette() {
    document[_0xc373[27]](_0xc373[339])[_0xc373[25]] = document[_0xc373[27]](_0xc373[339])[_0xc373[25]] + _0xc373[340] + selectedColor + _0xc373[341] + selectedColor + _0xc373[342] + selectedColor + _0xc373[343]
}

function RGB2HSV(e) {
    return hsv = new Object, max = max3(e[_0xc373[98]], e[_0xc373[96]], e[_0xc373[118]]), dif = max - min3(e[_0xc373[98]], e[_0xc373[96]], e[_0xc373[118]]), hsv[_0xc373[344]] = 0 == max ? 0 : 100 * dif / max, 0 == hsv[_0xc373[344]] ? hsv[_0xc373[345]] = 0 : e[_0xc373[98]] == max ? hsv[_0xc373[345]] = 60 * (e[_0xc373[96]] - e[_0xc373[118]]) / dif : e[_0xc373[96]] == max ? hsv[_0xc373[345]] = 120 + 60 * (e[_0xc373[118]] - e[_0xc373[98]]) / dif : e[_0xc373[118]] == max && (hsv[_0xc373[345]] = 240 + 60 * (e[_0xc373[98]] - e[_0xc373[96]]) / dif), hsv[_0xc373[345]] < 0 && (hsv[_0xc373[345]] += 360), hsv[_0xc373[42]] = Math[_0xc373[338]](100 * max / 255), hsv[_0xc373[345]] = Math[_0xc373[338]](hsv[_0xc373[345]]), hsv[_0xc373[344]] = Math[_0xc373[338]](hsv[_0xc373[344]]), colhue = hsv[_0xc373[345]], colsat = hsv[_0xc373[344]], colval = hsv[_0xc373[42]], hsv
}
var _0xc373 = ["duma", "", "yo", "resizable", ".CodeMirror", "=", "length", "cookie", "substring", "here", " ", "indexOf", "FirstTimeVisitHere", "getTime", "FirstTimeVisitHere=here; expires=", '\x3c!-- #######  THIS IS A COMMENT - Visible only in the source editor #########--\x3e\n<h2>Welcome To The Best Online HTML Web Editor!</h2>\n<p style="font-size: 1.5em;">You can <strong style="background-color: #317399; padding: 0 5px; color: #fff;">type your text</strong> directly in the editor or paste it from a Word Doc, PDF, Excel etc.</p>\n<p style="font-size: 1.5em;">The <strong>visual editor</strong> on the right and the <strong>source editor</strong> on the left are linked together and the changes are reflected in the other one as you type! <img src="https://html5-editor.net/images/smiley.png" alt="smiley" /></p>\n<table class="editorDemoTable">\n<tbody>\n<tr>\n<td><strong>Name</strong></td>\n<td><strong>City</strong></td>\n<td><strong>Age</strong></td>\n</tr>\n<tr>\n<td>John</td>\n<td>Chicago</td>\n<td>23</td>\n</tr>\n<tr>\n<td>Lucy</td>\n<td>Wisconsin</td>\n<td>19</td>\n</tr>\n<tr>\n<td>Amanda</td>\n<td>Madison</td>\n<td>22</td>\n</tr>\n</tbody>\n</table>\n<p>This is a table you can experiment with.</p>', "setValue", "getValue", "setTime", "; expires=", "toGMTString", "; path=/", ";", "split", "charAt", "innerHTML", "popupUzenet", "getElementById", "display", "style", "popupUzenetBox", "block", "getContent", "elm1", "get", "setContent", "activeEditor", "inputLength", "Source: ", "replace", "none", "You reached the limit", "value", "textarea#elm1", "modern", "named", "advlist autolink link image lists charmap print preview hr anchor", "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking", "table directionality emoticons paste textcolor", "undo redo | code | removeformat | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | print preview media fullpage | forecolor backcolor emoticons table", "Heading 1", "h1", "Heading 2", "h2", "Heading 3", "h3", "Heading 4", "h4", "Paragraph", "p", "Block Quote", "blockquote", "Red text", "span", "#ff0000", "Green text", "#00ff00", "Blue text", "#0000ff", "560", "change", "on", "keyup", "undo", "redo", "focus", "blur", "init", "elmentettszettingek", "backgroundPosition", "optionButton", "10px 0px", "10px -66px", "100%", "setSize", "remove", "raw", "https://html5-editor.net/tinymce/skins/lightgray/content.min-bootstrap.css", "loadCSS", "dom", "<", "!", "-", "a", "i", "m", "g", "h", "r", "e", "f", "d", "o", "w", "n", "l", "s", "c", '"', "7", "6", "17", "16", ">", "/", "join", "\n", "&", "b", "eleje.concat(vege)", "t", "y", "D", "O", "C", "T", "L", "I", "N", "K", "k", "M", "E", "A", "B", "S", "R", "H", "G", "u", "\t", "]", "  ", " \n", "\t\n", "\n\n", "<script", "<\/script>", "<style", "</style>", "<style</style>", "<script<\/script>", "Inline styles have been removed. Include these as seperate .ccs files if needed!", "Inline styles and scripts have been removed. Include these as seperate files if needed!", "Inline scripts have been removed. Include these as seperate files if needed!", "\x3c!--", "&%&%&%&%&%!--", "<>", "style = ", "style=", "style= ", "style =", 'style="', 'style=""', "valign = ", "valign=", "valign= ", "valign =", 'valign="', 'valign=""', "align = ", "align=", "align= ", "align =", 'align="', 'align=""', "&nbsp;&nbsp;", "&nbsp; ", " &nbsp;", " class = ", " class=", " class= ", " class =", ' class="', ' class=""', " id = ", " id=", " id= ", " id =", ' id="', ' id=""', "<i ", "<b ", "<i>", "<em>", "<i >", "</i>", "</em>", "<b>", "<strong>", "<b >", "</b>", "</strong>", "<table", "<thead", "<tfoot", "<tbody", "<td", "<tr", "<th", "<table>", "<thead>", "<tfoot>", "<tbody>", "<td>", "<tr>", "<th>", "</table>", "</thead>", "</tfoot>", "</tbody>", "</td>", "</tr>", "</th>", '<div class="rTableHeading">', '<div class="rTable">', '<div class="rTableBody">', '<div class="rTableFoot">', '<div class="rTableCell">', '<div class="rTableRow">', '<div class="rTableHead">', "</div>", "<a ", "<a >", "<a>", "</a>", "<span ", "<span >", "<span>", "</span>", "<img ", "<img >", "<img>", "</img>", "--\x3e", "\x3c!----\x3e", "> &nbsp;<", ">&nbsp;<", ">&nbsp; <", "> <", "><", "> \n", ">\n", " >", "&nbsp;\n", "l5-ed", "domain", "onTheConvertButton", "-175px -25px", "cursor", "body", "default", "fadeOut", ".programIsThinking", ".overlayContainer", ".replaceList", "hanyparagrafuslegyen", "szettingform", "\n<p>Lorem ipsum dolor sit amet, nonumes voluptatum mel ea, cu case ceteros cum. Novum commodo malorum vix ut. Dolores consequuntur in ius, sale electram dissentiunt quo te. Cu duo omnes invidunt, eos eu mucius fabellas. Stet facilis ius te, quando voluptatibus eos in. Ad vix mundi alterum, integre urbanitas intellegam vix in.</p>", "\n<p>Eum facete intellegat ei, ut mazim melius usu. Has elit simul primis ne, regione minimum id cum. Sea deleniti dissentiet ea. Illud mollis moderatius ut per, at qui ubique populo. Eum ad cibo legimus, vim ei quidam fastidii.</p>", "\n<p>Quo debet vivendo ex. Qui ut admodum senserit partiendo. Id adipiscing disputando eam, sea id magna pertinax concludaturque. Ex ignota epicurei quo, his ex doctus delenit fabellas, erat timeam cotidieque sit in. Vel eu soleat voluptatibus, cum cu exerci mediocritatem. Malis legere at per, has brute putant animal et, in consul utamur usu.</p>", "\n<p>Te has amet modo perfecto, te eum mucius conclusionemque, mel te erat deterruisset. Duo ceteros phaedrum id, ornatus postulant in sea. His at autem inani volutpat. Tollit possit in pri, platonem persecuti ad vix, vel nisl albucius gloriatur no.</p>", "\n<p>Ea duo atqui incorrupte, sed rebum regione suscipit ex, mea ex dicant percipit referrentur. Dicat luptatum constituam vix ut. His vide platonem omittantur id, vel quis vocent an. Ad pro inani zril omnesque. Mollis forensibus sea an, vim habeo adipisci contentiones ad, tale autem graecis ne sit.</p>", "\n<p>Ex quod meis per, ea paulo eirmod intellegam usu, eam te propriae fabellas. Nobis graecis has at, an eum audire impetus. Ius epicuri verterem ex, qui cu solet feugiat consetetur. Placerat apeirian et sea, nec wisi viderer definiebas ex, at eum oratio honestatis.</p>", "\n<p>Eum illum nulla graeci at, mea quis munere indoctum at. In sea partiendo hendrerit. Quaestio partiendo an eam, rebum vitae accumsan ius id. Duo at causae option.</p>", "\n<p>At persius imperdiet vis, ea elit atqui aperiri mei, percipit maiestatis sea eu. Has et partem hendrerit, vim cibo veniam aliquid an. No pri populo abhorreant, everti mandamus ne mea. Debitis forensibus suscipiantur ius cu. Ei per possim verterem, et iudico voluptatum eos.</p>", "\n<p>Te mel meis adhuc. Choro percipit mei eu, fabulas fuisset tibique ad sea, cu eos sint falli iracundia. Usu ex minimum corrumpit, postea dolores salutandi ne est, cu nam option recusabo reprehendunt. Prima vocibus argumentum ex usu. Nam te legere salutatus dissentiunt, his ei principes prodesset, est possit blandit ex.</p>", "\n<p>Pro no rebum timeam necessitatibus, et mnesarchum quaerendum has. Duo molestie interesset at. Vel ad legere populo. Sed ne saepe doming perpetua. Omnis iuvaret volumus an duo, qui duis audiam fabellas in.</p>", "\n<p>Has in erant eruditi vituperatoribus, facer copiosae nam ex. Ne quo error rationibus, cum ea accusam comprehensam. Quo no nihil rationibus intellegam. Duo ea justo deleniti tincidunt, per et erant volumus consequat, per simul consulatu ne. Efficiendi contentiones mel id, ad quaeque facilis vel. Ius mutat nullam ut, dolores officiis platonem qui ex.</p>", "\n<p>Et cum quem movet nonumes, at molestie mandamus intellegebat eum, at habeo vulputate vel. An nec diam consequuntur, quo an diam numquam theophrastus. Et unum possit sit. Suas ludus sea an. Quo expetendis consetetur an, no perpetua consequuntur cum. Congue tritani delenit eam an. Porro albucius id mei, ut fabellas scripserit interesset vis.</p>", "\n<p>Eos causae albucius deseruisse ea, mel augue eirmod convenire no. Ad volutpat consulatu definiebas sea, nec integre scribentur ei. Principes mnesarchum mea ei, dicam laboramus abhorreant an has. Mutat iuvaret pri ea, id quo reque libris deseruisse. Ut aeterno denique minimum duo, indoctum reformidans id pro.</p>", "\n<p>Alii dissentias eu eum, ei vix exerci laudem placerat. Ius at sonet saepe theophrastus, atqui qualisque urbanitas no sit, aperiam vulputate sadipscing te eam. An dolor mediocrem patrioque qui, his propriae laboramus scripserit in, ne ubique tamquam has. Tempor aperiri nominati vis eu. At recteque gloriatur eum, viris referrentur sit ut, et tota solum pri.</p>", "\n<p>Quidam lobortis intellegat ea mel. Aeterno facilis mea ne. Omittam periculis no eos, duo cu sale autem ullum, legere tritani ut eos. In vix adhuc facer. Nec erat commodo efficiendi eu. Et nusquam lucilius splendide pro, at nostro constituam appellantur sea.</p>", "\n<p>Ei iriure fastidii sea, vim ut vivendum pertinacia. Cu dolor perpetua his, debet doctus definitiones an sit. Velit ridens propriae in vix. Qui ut justo essent lucilius, no choro doming pro.</p>", "\n<p>Est in eros contentiones, te dicit explicari tincidunt duo. No duo vocent perpetua salutatus, his ut essent placerat. Cu error argumentum sea. In sed eirmod veritus, te mundi utamur per. Ne sit case inani tollit, ea mel autem partiendo. Eum solum animal alterum ei. Sea quem oportere eu.</p>", "\n<p>At ius ipsum prodesset. Pro menandri evertitur constituam ut, in elit porro repudiare usu, nusquam praesent comprehensam est te. Autem mnesarchum nam te. Libris qualisque nam an. Ei nam diam putant facilis. Quis deleniti no vel, liber perfecto ei cum, vim ea inermis imperdiet.</p>", "\n<p>Id vide albucius lobortis pri. Mel saperet habemus scriptorem eu, harum pertinax euripidis vel ne. Dolor accumsan reprimique sit an. Ad veri vitae fuisset cum, nostrum gloriatur vix id. Perfecto voluptatum at mel, te ius dicant vituperatoribus.</p>", "\n<p>Sed ne appellantur ullamcorper. Dicant persius quaestio et per, assum tritani omittantur vix no, vix suas aliquip ut. Per meis rationibus ut, eum ut delicata laboramus. An vix brute eruditi ocurreret, ex nec animal omnesque assentior, voluptatibus conclusionemque usu ne. Quo perpetua argumentum referrentur ei, cum idque phaedrum at. Quodsi instructior voluptatibus pri ex. Nec munere ornatus ut, mediocrem partiendo eu nam.</p>", "mitpupulaljon", "lipszuTextarea", "fadeIn", "#lipszuTextarea", ".lipsumText", ".tagManager", ".colorPicker", ".settingsList", "hidePicker", "color", "myColor", "ffffff", "A szin neve", "css", "#myColor", "selectedbackgr", '<div class="szinInfok" style="color: ', '"><span class="uppercase">#', "</span><br />rgb(", ",", ")<br />CMYK( ", ", ", ")<br />Hue: ", ", Saturation: ", ", Value: ", ' <div class="saveOrLink"><a id="addToPalette" style="color:#', ";background-color:", '" onClick = "addtopalette();" title="Add to palette">Save</a></div></div>', "openColorLink", '<a class="buttonka" href="https://rgbcolorcode.com/color/', '" target="_blank" title="Open #', ' in the color mixer">Color Mixer</a>', "backgroundColor", "#", "border-top", "3px solid #", "#colorToUse>div", "colorToUse", '<h5>Click and Copy:</h5><input onClick="this.select();" value="color:#', ';" /><input onClick="this.select();" value="style=&quot;color:#', ';&quot;" /><input onClick="this.select();" value="background-color:#', ';" /><input onClick="this.select();" value="style=&quot;background-color:#', ';&quot;" /><input onClick="this.select();" value="border: 3px solid #', ';"/ ><input onClick="this.select();" value="text-shadow: 1px 2px 2px #', ';" / ><input onClick="this.select();" value="box-shadow: 2px 2px 7px 1px #', ';" / >', "fromString", "Please enter numeric RGB values!", "RGB values must be in the range 0 to 255.", "min", "round", "savedCodes", '<div class="savedPalette" style="background-color:#', '"><div onclick="aplikal(\'', '\');" class="aplikalo" title="Activate">&#10138;</div><input onClick="this.select();" value=#', " /> </div>", "saturation", "hue", "height", "#wrapAs", '<iframe style="border: none;width: 300px;height: 100px;overflow: hidden;" src="https://disableadblock.com/widget/small/?site=html5-editor" width="300" height="100" scrolling="no"></iframe><br /><h3>I promise that I\'ll show only two&nbsp;pretty&nbsp;ads.<br /><br />Thank you ðŸ˜€</h3>', "html", "#sidebarContent", "click", "#findreplacenow", ".overlayer", ".settingsDefault", ".settingsOk", ".windowHeader", ".closeButtonka", ".cleanOptionsToggle", ".findundreplace", ".lipszum", ".colorPickerOpen", ".tagManagerOpen", "-175px 0px", "cleanButtonText", "#000;", "wait", "show", "Input too long", ".performCleaning", "font-size", "px", ".CodeMirror-code", "line-height", ".sourceSmallerFont", ".sourceBiggerFont", ".textBiggerSmaller span", ".useBootstrapCss", ".compressHTML", "ready"],
    hanyoption = 17,
    hanyadikclean = 0,
    opt = new Array,
    text = _0xc373[0],
    undotext = _0xc373[1],
    beforeDemoText = _0xc373[2],
    replaceaktiv = new Array,
    wysiwygActive = 0,
    sourceFontSize = 14,
    useBootstrp = 0;

var selectedColor = _0xc373[299],
    colhue = 0,
    colsat = 0,
    colval = 0;
$(document)[_0xc373[379]](function () {
    $(_0xc373[347])[_0xc373[346]]() > 0 || $(_0xc373[350])[_0xc373[349]](_0xc373[348]), $(_0xc373[352])[_0xc373[351]](function () {
        findandreplacenow()
    }), $(_0xc373[353])[_0xc373[351]](function () {
        popupokatLevesz()
    }), $(_0xc373[354])[_0xc373[351]](function () {
        setDefaultOptions()
    }), $(_0xc373[355])[_0xc373[351]](function () {
        popupokatLevesz()
    }), $(_0xc373[356])[_0xc373[351]](function () {
        popupokatLevesz()
    }), $(_0xc373[357])[_0xc373[351]](function () {
        popupokatLevesz()
    }), $(_0xc373[358])[_0xc373[351]](function () {
        $(_0xc373[264])[_0xc373[290]](200), $(_0xc373[295])[_0xc373[290]](200)
    }), $(_0xc373[359])[_0xc373[351]](function () {
        $(_0xc373[264])[_0xc373[290]](200), $(_0xc373[265])[_0xc373[290]](200)
    }), $(_0xc373[360])[_0xc373[351]](function () {
        $(_0xc373[264])[_0xc373[290]](200), $(_0xc373[292])[_0xc373[290]](200)
    }), $(_0xc373[361])[_0xc373[351]](function () {
        $(_0xc373[264])[_0xc373[290]](200), $(_0xc373[294])[_0xc373[290]](200)
    }), $(_0xc373[362])[_0xc373[351]](function () {
        $(_0xc373[264])[_0xc373[290]](200), $(_0xc373[293])[_0xc373[290]](200)
    }), $(_0xc373[369])[_0xc373[351]](function () {
        if (sourceEditorFricc[_0xc373[17]]()[_0xc373[6]] < 85e3) {
            document[_0xc373[27]](_0xc373[257])[_0xc373[29]][_0xc373[79]] = _0xc373[363], document[_0xc373[27]](_0xc373[364])[_0xc373[29]][_0xc373[297]] = _0xc373[365], document[_0xc373[260]][_0xc373[29]][_0xc373[259]] = _0xc373[366], $(_0xc373[263])[_0xc373[367]]();
            setTimeout(function () {
                convertText()
            }, 150)
        } else popupBox(_0xc373[368]);
        ++hanyadikclean % 2 == 0 && sourceEditorFricc[_0xc373[17]]()[_0xc373[6]] > 2e3 && szoveghezLinketAd(), popupokatLevesz()
    }), $(_0xc373[374])[_0xc373[351]](function () {
        sourceFontSize > 8 && sourceFontSize-- , $(_0xc373[372])[_0xc373[301]](_0xc373[370], sourceFontSize + _0xc373[371]), $(_0xc373[372])[_0xc373[301]](_0xc373[373], sourceFontSize + 2 + _0xc373[371])
    }), $(_0xc373[375])[_0xc373[351]](function () {
        sourceFontSize < 25 && sourceFontSize++ , $(_0xc373[372])[_0xc373[301]](_0xc373[370], sourceFontSize + _0xc373[371]), $(_0xc373[372])[_0xc373[301]](_0xc373[373], sourceFontSize + 2 + _0xc373[371])
    }), $(_0xc373[376])[_0xc373[351]](function () {
        sourceFontSize = 14, $(_0xc373[372])[_0xc373[301]](_0xc373[370], sourceFontSize + _0xc373[371]), $(_0xc373[372])[_0xc373[301]](_0xc373[373], sourceFontSize + 2 + _0xc373[371])
    }), $(_0xc373[377])[_0xc373[351]](function () {
        tinyMCE[_0xc373[36]][_0xc373[89]][_0xc373[88]](_0xc373[87]), $(_0xc373[377])[_0xc373[262]](200), useBootstrp = 1
    }), $(_0xc373[378])[_0xc373[351]](function () {
        undotext = tinymce[_0xc373[34]](_0xc373[33])[_0xc373[32]](), text = undotext, helyettesit(_0xc373[116], _0xc373[1]), torolTagbanKettoKozt(_0xc373[155], _0xc373[244]), helyettesit(_0xc373[245], _0xc373[1]), sourceEditorFricc[_0xc373[16]](text), tinyMCE[_0xc373[36]][_0xc373[35]](text), document[_0xc373[27]](_0xc373[37])[_0xc373[25]] = _0xc373[38] + text[_0xc373[6]]
    })
});