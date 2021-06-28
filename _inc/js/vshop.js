
function storageAvailable(type) {
    var storage;
    try {
        storage = window[type];
        var x = '__storage_test__';
        storage.setItem(x, x);
        storage.removeItem(x);
        return true;
    }
    catch(e) {
        return e instanceof DOMException && (
            // Firefox를 제외한 모든 브라우저
            e.code === 22 ||
            // Firefox
            e.code === 1014 ||
            // 코드가 존재하지 않을 수도 있기 떄문에 이름 필드도 확인합니다.
            // Firefox를 제외한 모든 브라우저
            e.name === 'QuotaExceededError' ||
            // Firefox
            e.name === 'NS_ERROR_DOM_QUOTA_REACHED') &&
            // 이미 저장된 것이있는 경우에만 QuotaExceededError를 확인하십시오.
            (storage && storage.length !== 0);
    }
}



var app = new Vue({
    el: '#app',
    data: {
        title: '',
        isLoading: false,
        previousBtn: false,
        nextBtn: true,
        errorMsg: false,
        successMsg: false,
        showCont: false,
        addNew: false,
        slider: false,
        imgSize: false,
        showtab1: true,
        showtab2: false,
        showtab3: false,
        showtabs: [{ text: '상세정보', value: 'detail' }, { text: '안내사항', value: 'detail2' }, { text: '상품리뷰', value: 'comment' }],
        options: [],
        cardinfo: [],
        options1: [],
        options2: [],
        selopt2: '',
        field1s: [],
        field2s: [],
        field3s: [],
        field4s: [],
        lists: [],
        item_price: 0,
        ea: 1,
        submenus: [],
        serverUrl: '',
        newBoard: { title: "", xmid: "", member_id: "", member_name: "", item_made: "", xthum_pic: "", item_oprice: "0", item_price: "0", item_point: "0", item_ea: "1", x_attr1: "", x_attr2: "", x_attr3: "", x_attr4: "", item_opt1_t: "", item_opt2_t: "", item_opt1: "", item_opt2: "", item_field1: "", item_field2: "", item_field3: "", field1: "", field2: "", field3: "", field4: "", cust_sort: "", noti: 0, passwd: "", item_name: "", content: "", cate_id1: "", cate_id2: "", getcomment: "", xpoc: "", x_wsize: "", x_hsize: "", slider: "", ximgfix: "", wdate: "" },
        boardCont: '',
        boardCmt: [],
        cmtTemp: null,
        newComment: {
            id:"",
            rating: "",
            board_id: "",
            member_id: "",
            member_name: "",
            comment: "",
            add_files: "",
            file_cmt: ""
        },
        intro: 1,
        shopinfo:'',
        files: [],
        pageNum: 1,
        totalNum: 0,
        listNum: 10,
        totalPage: 0,
        modifyData: false,
        fpicTemp: '',
        categ: 0,
        categ2: 0,
        isCmt: true,
        home_id: '',
        UIDVar: { member_id: "", member_name: "" },
        initmce: 0,
        inCart: [],
        userData:'',
        cartObj: { mid: "", title: "", item_name: "", thum_pic: "", option1: "", option2: "", item_ea: "", item_price: "", id: "", categ: "" ,categ2: "",home_id:"" },
        rdue: '',
        newId: 0,
        keyf: 'title',
        keyn: '',
        keyt: '',
		shopTitle:'',
		goback:0,
        orderby: 'item_attr-desc'


    },
    mounted: function () {

        this.categ = this.$el.getAttribute('data-categ');
        this.categ2 = this.$el.getAttribute('data-categ2');
        var mid = this.$el.getAttribute('data-mid');
        this.title = this.$el.getAttribute('data-label');
        this.UIDVar.member_id = this.$el.getAttribute('data-member_id');
        this.UIDVar.member_name = this.$el.getAttribute('data-member_name');
		this.shopTitle = this.$el.getAttribute('data-shop_title');
if (storageAvailable('localStorage')) {
        if (localStorage.getItem('myCart')) {
            try {
                this.inCart = JSON.parse(localStorage.getItem('myCart'));
            } catch (e) {
                localStorage.removeItem('myCart');
            }
        }
} 

        this.getAllDatas(this.pageNum, mid);
        history.pushState(null, null, location.href);
        window.onpopstate = function () {
app.goback-=1;
            app.showCont = false;
            app.cmtTemp = null;
            app.modifyData = false;
            app.addNew = false;
            app.resetData();
			console.log("\napp.goback="+app.goback);
			if(app.goback<0){history.go(0);}else{history.go(1);}

            setTimeout(function () { document.documentElement.scrollTop = 0; }.bind(this), 200);
            //$('html').scrollTop(0);
            // document.documentElement.scrollTop = 0;
            //document.body.scrollTop = 0;

        };
        $("#vshop").css("display", "block");

    },
    filters: {
        truncate: function (text, length, suffix) {
            if (text.length > length) {
                return text.substring(0, length) + suffix;
            } else {
                return text;
            }
        },
        video: function (text) {
            var texttemp = text.replace(/\<iframe/gim, '<div class="videoc"><iframe ');
            return texttemp.replace(/iframe\>/gim, "iframe></div>");
        },
        nl2br: function (text) {

            return text.replace(/\n/g, "<br />");
        },
        currency: function (value) {
            if (value < 0) { value = 0; }
            var num = new Number(value);
            return num.toFixed(0).replace(/(\d)(?=(\d{3})+(?:\.\d+)?$)/g, "$1,")
        }
    },
    methods: {
        getUser: function (member_id) {

            axios.get("/module/hutech/load_user.php?uid="+member_id).then(function (response) {
                if (response.data.ResultCode != 100) {
                    app.errorMsg = response.data.ResultMessage;
                
                } else {
                
                    app.userData = response.data.cont;
                    
                   // if(!app.userData.email){app.userData.email=app.userData.member_id;}

                }

            })
        },
        

        addnewb: function () {
            if (app.addNew == false) {
                app.addNew = true;
                app.showCont = false;
                initp(app.initmce);
                app.initmce = app.initmce + 1;


                //var text1 = $("#elm1").val();
                //setTimeout(() => { initoptions(); $("#title").focus(); }, 200);

                if (screen.width > 500) {
                    setTimeout(function () { $("#title").focus(); initoptions(); }.bind(this), 200);
                } else {
                    setTimeout(function () { $("#title").focus(); initoptionm(); }.bind(this), 200);
                }



            }

        },
        onChange: function (event) {
            this.getAllDatas(this.pageNum);
        },
        nextPage: function () {
			app.goback+=1;
            this.showCont = false;
            this.pageNum += 1;
            this.previousBtn = true;
            if (this.pageNum == this.totalPage) {
                this.nextBtn = false;
            }
            this.cmtTemp = null;
            this.getAllDatas(this.pageNum);
        },
        prevPage: function () {
			app.goback+=1;
            this.showCont = false;
            this.pageNum -= 1;
            if (this.pageNum < 2) {
                this.previousBtn = false;
            }
            this.cmtTemp = null;
            this.nextBtn = true;
            this.getAllDatas(this.pageNum);
        },

        checkSlider: function () {
            if (app.slider == false) { app.slider = true; } else {
                app.slider = false;
            }
        },
        checkimgSize: function () {
            if (app.imgSize == false) { app.imgSize = true; } else {
                app.imgSize = false;
            }
        },
        gocart: function () {
            app.addcart();
            // window.location.href = "/page/checkout";
        },
        addcart: function (k) {
            app.inCart=[];
            if(app.rdue=="STANDARD"){
            app.options=app.field1s;
            }else if(app.rdue=="DELUXE"){
                app.options=app.field2s;
            }else{app.options=app.field3s;}

            if (k >= 0) {
                var index = this.inCart.findIndex(function (item) { return item.mid === app.lists[k].id; });

            } else {
                var index = this.inCart.findIndex(function (item) { return item.mid === app.newBoard.xmid; });
            }


            if (index >= 0 && app.inCart.length > 0) {
               // alert(app.newBoard.title + " 상품을 이미 카트에 추가하였습니다. ");
            } else {

                if (k >= 0) {
                    //상품리스트에서 카트추가
                    app.newId = app.inCart.length + 1;
                    app.cartObj.mid = app.lists[k].id;
                   // app.cartObj.title = app.lists[k].title;
                    app.cartObj.title = app.options[1];
                    app.cartObj.item_name = app.lists[k].item_name;
                    app.cartObj.thum_pic = app.lists[k].thum_pic;
                    app.cartObj.categ = app.lists[k].cate_id1;
                    app.cartObj.categ2 = app.lists[k].cate_id2;
                    app.cartObj.home_id = app.lists[k].member_id;
                    //옵션선택없으면 standard자동선택
                    if (app.rdue == '') {
                       
                     
                        app.rdue = "STANDARD";
                        app.cartObj.item_price = field1s[3];

                     }

                    app.cartObj.option1 = app.rdue;
                   // app.rdue = '';
                    app.cartObj.item_ea = app.ea;
                    //app.cartObj.item_price = app.item_price;
                    app.cartObj.id = app.newId;

                } else {

                    //상품페이지에서 카트추가
                    //alert(k);
                    app.newId = app.inCart.length + 1;
                    app.cartObj.mid = app.newBoard.xmid;
                  //  app.cartObj.title = app.newBoard.title;
                    app.cartObj.title = app.options[1];
                    app.cartObj.item_name = app.newBoard.item_name;
                    app.cartObj.thum_pic = app.newBoard.xthum_pic;
                    app.cartObj.categ = app.newBoard.cate_id1;
                    app.cartObj.categ2 = app.newBoard.cate_id2;
                    app.cartObj.home_id = app.newBoard.member_id;
                    if (app.rdue == '') { app.rdue = "STANDARD"; }
                    app.cartObj.option1 = app.rdue;

                    if (app.newBoard.item_opt2_t != '') {
                        if (app.selopt2 == '') {
                            app.cartObj.option2 = app.options2[0];

                            // alert(app.newBoard.item_opt2_t + " 항목을 선택해주세요!");
                            // return false;
                        } else {
                            app.cartObj.option2 = app.selopt2;
                            //   alert(app.selopt2);
                        }

                    }
                    app.selopt2 = '';
                    //app.rdue = '';
                    app.cartObj.item_ea = app.ea;
                    app.cartObj.item_price = app.item_price;
                    app.cartObj.id = app.newId;
                }
                //alert("카트에 추가하였습니다. 담긴 상품수 총" + app.newId + "개");

                this.inCart.push(app.cartObj);

                this.cartObj = { mid: "", title: "", item_name: "", option1: "", item_ea: "", item_price: "", id: "", categ: "" , categ2: "",home_id:""};
                this.saveCart();
            }

        },
        removeCart: function (x) {
            this.inCart.splice(x, 1);
            this.saveCart();
        },
        saveCart: function () {

            const parsed = JSON.stringify(this.inCart);
            localStorage.setItem('myCart', parsed);

            //document.getElementById("cartcnt").innerHTML = this.inCart.length;
            $("span.indicator__value").html(app.inCart.length);


        },

        searchPage: function () {
            app.head = '';
            this.getAllDatas(1);
            //if (app.keyf == "title") { app.keyt = "제목"; } else if (app.keyf == "content") { app.keyt = "내용"; } else if (app.keyf == "member_name") { app.keyt = "작성자"; }
            this.showCont = false;
            document.documentElement.scrollTop = 0;

        },
        getAllDatas: function (page, m_id) {
				

            axios.get("/module/vshop/load_board.php?page=" + page + "&categ=" + this.categ + "&categ2=" + this.categ2 +  "&keyf=" + this.keyf + "&keyn=" + this.keyn + "&orderby=" + this.orderby + "&mid=" + m_id).then(function (response) {
                if (response.data.ResultCode != 100) {
                    app.errorMsg = response.data.ResultMessage;
                } else {
                    //app.categ = response.data.categ;
                    app.lists = response.data.list;
                    app.submenus = response.data.submenu;
                    app.totalNum = response.data.total;
                    app.home_id = response.data.home_id;
                    app.totalPage = Math.ceil(response.data.total / response.data.listnum);
                    app.serverUrl = response.data.ServerUrl;
                    //alert(app.lists[0].id);

                    if (app.totalPage == 1) { app.nextBtn = false; } else if (app.pageNum == app.totalPage) {
                        app.nextBtn = false;
                    } else { app.nextBtn = true; }

                    if (m_id) {
                        // alert(response.data.cont.id);
                        //app.modifyData = false;
                        //app.addNew = false;
                        //alert(app.lists[k].title);
                        app.boardCont = response.data.cont;
                        app.newBoard.xmid = response.data.cont.id;
                        app.newBoard.title = response.data.cont.title;
                        app.newBoard.member_id = response.data.cont.member_id;
                        app.newBoard.member_name = response.data.cont.member_name;
                        app.newBoard.item_made = response.data.cont.item_made;
                        app.newBoard.xthum_pic = response.data.cont.thum_pic;
                        app.newBoard.item_oprice = response.data.cont.item_oprice;
                        app.newBoard.item_price = response.data.cont.item_price;
                        app.item_price = response.data.cont.item_price;
                        app.newBoard.item_point = response.data.cont.item_point;
                        app.newBoard.item_ea = response.data.cont.item_ea;
                        app.newBoard.x_attr1 = response.data.cont.item_new;
                        app.newBoard.x_attr2 = response.data.cont.item_sale;
                        app.newBoard.x_attr3 = response.data.cont.item_hot;
                        app.newBoard.x_attr4 = response.data.cont.item_pop;
                        app.newBoard.item_opt1_t = response.data.cont.item_opt1_t;
                        app.newBoard.item_opt2_t = response.data.cont.item_opt2_t;
                        app.newBoard.item_opt1 = response.data.cont.item_opt1;
                        app.newBoard.item_opt2 = response.data.cont.item_opt2;
                        app.newBoard.item_field1 = response.data.cont.item_field1;
                        app.newBoard.item_field2 = response.data.cont.item_field2;
                        app.newBoard.item_field3 = response.data.cont.item_field3;
                        app.newBoard.field1 = response.data.cont.field1;
                        app.newBoard.field2 = response.data.cont.field2;
						if (response.data.cont.field1) {
                        app.field1s = response.data.cont.field1.split('|');

						}else{app.field1s = response.data.cont.field1;}
						if (response.data.cont.field2) {
                        app.field2s = response.data.cont.field2.split('|');
						}else{app.field2s = response.data.cont.field2;}
                        app.newBoard.field3 = response.data.cont.field3;
                        app.newBoard.field4 = response.data.cont.field4;
                        if (response.data.cont.field3) {
                            app.field3s = response.data.cont.field3.split('|');
                        }
                        if (response.data.cont.field4) {
                            app.field4s = response.data.cont.field4.split('/');
                        }

                        app.newBoard.cust_sort = response.data.cont.cust_sort;

                        app.options1 = response.data.cont.option1;
                        app.options2 = response.data.cont.option2;

                ;
                        app.rdue="STANDARD";
            

                        app.newBoard.noti = Number(response.data.cont.noti);
                        app.newBoard.slider = Number(response.data.cont.slider);
                        app.newBoard.item_name = response.data.cont.item_name;
                        app.newBoard.getcomment = response.data.cont.getcomment;
                        app.newBoard.content = response.data.cont.content;
                        app.newBoard.cate_id1 = response.data.cont.cate_id1;
                        app.newBoard.cate_id2 = response.data.cont.cate_id2;
                        app.newBoard.wdate = response.data.cont.wdate;
                        if (Array.isArray(response.data.cont.fpic3)) {
                            app.newBoard.xpoc = response.data.cont.fpic3.length;
                            app.fpicTemp = response.data.cont.fpic3;
                        }
                        app.showCont = true;
                        if (app.newBoard.getcomment >= 1) {
                            app.getComments(m_id);
                        }
                        // alert(response.data.cont.title);



                    }
                }

            })
        },
        addBanner: function () {
				app.goback+=2;
            var formData = app.toFormData(app.newBoard);
            if (app.modifyData == true) {
                var plink = "m";
            } else {
                var plink = "i";
            }
            // alert(plink);
            axios.post("/module/vshop/dbj_process.php?tbl=vshop&idm=" + plink, formData, { headers: { 'Content-Type': 'multipart/form-data' } }).then(function (response) {
                //app.newBoard = { title: "", xmid: "", member_id: "", member_name: "", passwd: "", title_head: "", content: "", xpoc: "" };
                //app.files = [];
                //app.slider = false;
                //app.imgSize = false;
                // app.modifyData = false;
                // app.fpicTemp = '';
                app.resetData();


                if (response.data.ResultCode < 100) {
                    app.errorMsg = response.data.ResultMessage;
                    // setTimeout(() => { app.errorMsg = false; }, 5000);
                    setTimeout(function () { app.errorMsg = false; }.bind(this), 5000);
                    app.getAllDatas(app.pageNum);
                    app.isLoading = false;
                    //alert(response.data.ResultMessage);
                } else if (response.data.ResultCode >= 100) {
                    app.successMsg = response.data.ResultMessage;
                    //setTimeout(() => { app.successMsg = false; }, 5000);
                    setTimeout(function () { app.successMsg = false; }.bind(this), 5000);
                    app.getAllDatas(app.pageNum);
                    app.isLoading = false;
                    //alert(app.lists[0].id);
                } else {
                    alert(response.data.ResultCode);
                    console.log(response.data);
                    app.errorMsg = "전송실패! 이미지파일이 잘못되었거나 용량이 너무큽니다";
                    //setTimeout(() => { app.errorMsg = false; }, 5000);
                    setTimeout(function () { app.errorMsg = false; }.bind(this), 5000);
                    app.isLoading = false;
                }
            })


        },
        addPicsave: function () {
            var formData = app.toFormData(app.newBoard);
            if (app.modifyData == true) {
                var plink = "m";
            } else {
                var plink = "i";
            }
            axios.post("/module/vshop/dbt_process.php?tbl=vshop&idm=" + plink, formData, { headers: { 'Content-Type': 'multipart/form-data' } }).then(function (response) {

                if (response.data.ResultCode < 100) {
                    app.errorMsg = response.data.ResultMessage;
                    // setTimeout(() => { app.errorMsg = false; }, 5000);
                    setTimeout(function () { app.errorMsg = false; }.bind(this), 5000);
                    //alert(response.data.ResultMessage);
                } else if (response.data.ResultCode >= 100) {
                    app.successMsg = response.data.ResultMessage;

                    if (Array.isArray(response.data.fpic3)) {
                        app.newBoard.xpoc = response.data.fpic3.length;
                        app.fpicTemp = response.data.fpic3;
                        app.newBoard.member_id = app.UIDVar.member_id;
                    }
                    app.newBoard.xmid = response.data.mid;
                    app.modifyData = true;
                    app.files.length = 0;
                    //setTimeout(() => { app.successMsg = false; }, 5000);
                    setTimeout(function () { app.successMsg = false; }.bind(this), 5000);
                    //app.getPicDatas(app.pageNum);
                    //alert(app.lists[0].id);
                } else {
                    alert('이미지 전송실패! 이미지파일에 오류가 있거나 용량이 너무큽니다');
                    console.log(response.data);
                    app.files.length = 0;
                    app.errorMsg = "이미지 전송실패! 이미지파일이 잘못되었거나 용량이 너무큽니다";
                    //setTimeout(() => { app.errorMsg = false; }, 5000);
                    setTimeout(function () { app.errorMsg = false; }.bind(this), 5000);
                    // app.isLoading = false;
                }
            })


        },
        addCmt: function () {
            // var cmtData = app.toFormData(app.newComment);
            var cmtData = new FormData();
            //alert(app.newBoard.xmid);
            cmtData.append("comment", this.newComment.comment);
            cmtData.append("board_id", app.newBoard.xmid);

            if (app.modifyData == true) {
                var plink = "m";
            } else {
                var plink = "i";
            }
            // alert(plink);
            axios.post("/module/vshop/cmt_process.php?tbl=comment&idm=" + plink, cmtData).then(function (response) {


                if (response.data.ResultCode < 100) {
                    app.errorMsg = response.data.ResultMessage;
                    //setTimeout(() => { app.errorMsg = false; }, 5000);
                    setTimeout(function () { app.errorMsg = false; }.bind(this), 5000);

                    //alert(response.data.ResultMessage);
                } else if (response.data.ResultCode >= 100) {
                    app.lists[app.cmtTemp].getcomment = parseInt(app.lists[app.cmtTemp].getcomment) + 1;
                    app.getComments(app.newBoard.xmid);
                    app.newComment.comment = '';

                }
            })

        },
        newreview:function(){ 
            if(!app.UIDVar.member_id){
                alert('로그인먼저 해주세요!')
              
        
                return false;

            }
             app.newComment={    id:"",
             rating: "",
             board_id: "",
             member_id: "",
             member_name: "",
             comment: "",
             add_files: "",
             file_cmt: ""
         };
        
        },
        addReview: function () {
            // var cmtData = app.toFormData(app.newComment);
            if(app.newComment.rating==''){
                alert("별점을 선택해주세요.");
                return false;

            }
            var cmtData = new FormData();   
          //  alert(app.oCont.id);   
          cmtData.append("cate_id1", "1296");
          cmtData.append("item_id", app.newBoard.xmid);
            cmtData.append("content", this.newComment.comment);
            cmtData.append("title", app.newBoard.title);
            cmtData.append("user_data1", app.newComment.rating);
            cmtData.append("user_data2", app.userData.member_id);
            var fpic = '';
            var fpic_cmt = '';
            for (var j in this.fileTemp) {
                if (j == 0) {
                    fpic = this.fileTemp[j][0];
                    fpic_cmt = this.fileTemp[j][1];
                } else {
                    fpic += "|" + this.fileTemp[j][0];
                    fpic_cmt += "|" + this.fileTemp[j][1];
                }


            }

            cmtData.append("fpic", fpic);
            cmtData.append("fpic_cmt", fpic_cmt);



            if (app.modifyReview == true) {
                var plink = "m";
                cmtData.append("xmid", app.newComment.id);
            } else {
                var plink = "i";
            }
            // alert(plink);
            axios.post("/module/vshop/review_process.php?tbl=comment&idm=" + plink, cmtData).then(function (response) {


                if (response.data.ResultCode < 100) {
                    app.errorMsg = response.data.ResultMessage;
                    //setTimeout(() => { app.errorMsg = false; }, 5000);
                    setTimeout(function () {
                        app.errorMsg = false;
                    }.bind(this), 5000);

                    //alert(response.data.ResultMessage);
                } else if (response.data.ResultCode >= 100) {
                    // app.lists[app.cmtTemp].getcomment = parseInt(app.lists[app.cmtTemp].getcomment) + 1;
                    app.getComments(app.newBoard.xmid);
  
                    //app.oCont.status=app.newComment.rating;
                    app.newComment.comment = '';
                    app.newComment.rating = '';
                    app.files = [];
                    $('#sendMessage').modal('hide');
                }
            })

        },
        deleteData: function () {
            // alert(app.fpicTemp);
            if (confirm('are you sure to delete?')) {

                axios.post("/module/vshop/dbj_process.php?tbl=vshop&idm=d&xmid=" + app.newBoard.xmid, { xmid: app.newBoard.xmid }).then(function (response) {
                    // app.newBoard = { title: "", xmid: "", member_id: "", member_name: "", passwd: "", title_head: "", content: "", xpoc: "" };
                    // app.files = [];
                    // app.slider = false;
                    //app.imgSize = false;
                    // app.modifyData = false;

                    app.showCont = false;
                    app.addNew = false;
                    //  app.fpicTemp = '';
                    app.resetData();

                    if (response.data.ResultCode < 100) {

                        app.errorMsg = response.data.ResultMessage;
                        //setTimeout(() => { app.errorMsg = false; }, 5000);
                        setTimeout(function () { app.errorMsg = false; }.bind(this), 5000);
                    } else {

                        app.successMsg = response.data.ResultMessage;
                        //setTimeout(() => { app.successMsg = false; }, 5000);
                        setTimeout(function () { app.successMsg = false; }.bind(this), 5000);
                        app.getAllDatas(app.pageNum);
                        app.cmtTemp = null;
                    }
                });
            } else {
                return false;
            }
        },
        deleteCmt: function (cmt_id) {

            if (confirm('Delete a comment?')) {

                axios.post("/module/vshop/review_process.php?tbl=comment&idm=d&xmid=" + app.newBoard.xmid + "&cmt_id=" + cmt_id, { xmid: app.newBoard.xmid }).then(function (response) {

                    if (response.data.ResultCode < 100) {

                        app.errorMsg = response.data.ResultMessage;
                        // setTimeout(() => { app.errorMsg = false; }, 5000);
                        setTimeout(function () { app.errorMsg = false; }.bind(this), 5000);
                    } else {
                        app.lists[app.cmtTemp].getcomment = parseInt(app.lists[app.cmtTemp].getcomment) - 1;
                        app.getComments(app.newBoard.xmid);

                    }
                });
            } else {
                return false;
            }
        },
        toFormData: function (obj) {
            var fd = new FormData();

            var iframeEle = $('#elm1_ifr').contents().find('#tinymce').html();
            //alert(iframeEle);
            app.newBoard.content = iframeEle;
            app.newBoard.cate_id1 = this.categ;
            app.newBoard.cate_id2 = this.categ2;


            var product1="";
            var product2="";
            var product3="";
            for (var i in app.field1s) {
                product1 +=app.field1s[i]+"|";
                product2 +=app.field2s[i]+"|";
                product3 +=app.field3s[i]+"|";

           
            }
            app.newBoard.field1=product1.slice(0, -1);
            app.newBoard.field2=product2.substr(0, product2.length -1);
            app.newBoard.field3=product3.substr(0, product3.length -1);
          
            for (var i in obj) {
                fd.append(i, obj[i]);
         
            }


            if (app.modifyData == true) {
                if (Array.isArray(this.fpicTemp)) {
                    var xopc = this.fpicTemp.length;
                } else {
                    var xopc = 0;
                }
                //alert(xopc);
                fd.append("xopc", xopc);
                for (var j in this.fpicTemp) {

                    fd.append("xprepic_" + j, this.fpicTemp[j][0]);
                    fd.append("xfpic_cmt_" + j, this.fpicTemp[j][1]);
                    fd.append("xfpic_link_" + j, this.fpicTemp[j][2]);
                }

                
          


            }
            for (var i = 0; i < this.files.length; i++) {
                let file = this.files[i];

                fd.append('xf_name[' + i + ']', file);
            }

            return fd;
        },
        aDataFromList: function (k) {
			app.goback+=2;
            window.event.preventDefault();

            app.showCont = true;
            app.modifyData = false;
            app.addNew = false;

            //alert(app.lists[k].title);
            app.newBoard.xmid = app.lists[k].id;
            app.newBoard.title = app.lists[k].title;
            app.newBoard.member_id = app.lists[k].member_id;
            app.newBoard.member_name = app.lists[k].member_name;
            app.newBoard.xthum_pic = app.lists[k].thum_pic;
            app.newBoard.item_made = app.lists[k].item_made;
            app.newBoard.item_oprice = app.lists[k].item_oprice;
            app.newBoard.item_price = app.lists[k].item_price;
            app.item_price = app.lists[k].item_price;
            app.newBoard.item_point = app.lists[k].item_point;
            app.newBoard.item_ea = app.lists[k].item_ea;
            //let item_attr = app.lists[k].item_attr.toString();
            if (app.lists[k].item_new == 1) app.newBoard.x_attr1 = true;
            if (app.lists[k].item_sale == 1) app.newBoard.x_attr2 = true;
            if (app.lists[k].item_hot == 1) app.newBoard.x_attr3 = true;
            if (app.lists[k].item_pop == 1) app.newBoard.x_attr4 = true;
            app.options1 = app.lists[k].option1;
            app.options2 = app.lists[k].option2;
            app.rdue="STANDARD";
            

            //alert(app.lists[k].option1[0].text + app.lists[k].option1[0].value);
            app.newBoard.item_opt1_t = app.lists[k].item_opt1_t;
            app.newBoard.item_opt2_t = app.lists[k].item_opt2_t;
            app.newBoard.item_opt1 = app.lists[k].item_opt1;
            app.newBoard.item_opt2 = app.lists[k].item_opt2;

            app.newBoard.item_field1 = app.lists[k].item_field1;
            app.newBoard.item_field2 = app.lists[k].item_field2;
            app.newBoard.item_field3 = app.lists[k].item_field3;

            app.newBoard.field1 = app.lists[k].field1;
            app.newBoard.field2 = app.lists[k].field2;


            if (app.lists[k].field1) {
                app.field1s = app.lists[k].field1.split('|');
            }
            if (app.lists[k].field2) {
                app.field2s = app.lists[k].field2.split('|');
            }

            app.newBoard.field3 = app.lists[k].field3;
            app.newBoard.field4 = app.lists[k].field4;


            if (app.lists[k].field3) {
                app.field3s = app.lists[k].field3.split('|');
            }
            if (app.lists[k].field4) {
                app.field4s = app.lists[k].field4.split('/');
            }

            app.newBoard.cust_sort = app.lists[k].cust_sort;

            app.newBoard.noti = Number(app.lists[k].noti);
            app.newBoard.slider = Number(app.lists[k].slider);
            app.newBoard.item_name = app.lists[k].item_name;
            app.newBoard.content = app.lists[k].content;
            app.newBoard.cate_id1 = app.lists[k].cate_id1;
            app.newBoard.cate_id2 = app.lists[k].cate_id2;
            app.newBoard.getcomment = app.lists[k].getcomment;
            app.newBoard.wdate = app.lists[k].wdate;

      
            if (Array.isArray(app.lists[k].fpic3)) {
                app.newBoard.xpoc = app.lists[k].fpic3.length;
            }
            app.fpicTemp = app.lists[k].fpic3;
            //app.cmtTemp = app.lists[k].fpic_cmt;

            document.documentElement.scrollTop = 0;
            //alert(document.documentElement.scrollTop);
            if (app.newBoard.getcomment >= 1) {
                app.getComments(app.lists[k].id);
            }
            app.cmtTemp = k;
            app.getUser( app.newBoard.member_id);
        },
        getComments: function (m_id) {
            axios.get("/module/vshop/load_board.php?task=review&mid=" + m_id).then(function (response) {
                if (response.data.ResultCode != 100) {
                    app.errorMsg = response.data.ResultMessage;
                } else {
                    //app.categ = response.data.categ;
                    app.boardCmt = response.data.cmts;
                   
                    //app.totalNum = response.data.total;
                    app.home_id = response.data.home_id;
                    //app.totalPage = Math.ceil(response.data.total / response.data.listnum);
                    app.serverUrl = response.data.ServerUrl;
                    //alert(app.lists[0].id);
                    app.newBoard.getcomment = response.data.cmts.length;



                }

            })
        },

        aDataFromEdit: function () {
			app.goback+=2;

            app.modifyData = true;

            app.categ2 = app.newBoard.cate_id2;
            app.addnewb();


        },
        resetData: function () {
			
            app.files = [];
            app.slider = false;
            app.imgSize = false;
            app.modifyData = false;
            app.showtab1 = true;
            app.showtab2 = false;
            app.showtab3 = false;
            app.field1s = [];
            app.field2s = [];
            app.field3s = [];
            app.field4s = [];
            app.fpicTemp = '';
            app.selopt2 = '';
            app.rdue = '';



            for (var i in app.newBoard) {
                app.newBoard[i] = '';

            }
            app.newBoard.slider = true;

            $("[id^='mceu']").remove();

        },
        getCardinfo: function () {
            // app.newBoard.item_field1 
            axios.get("/module/vboard/load_board.php?task=cont&mid=" + app.newBoard.item_field2).then(function (response) {
                if (response.data.ResultCode != 100) {
                    app.errorMsg = response.data.ResultMessage;
                } else {
                    //app.categ = response.data.categ;
                    app.cardinfo = response.data.cont.content;
                }

            })
        }

        ,
        handleFileUpload: function () {
            // this.newBoard.xf_name = this.$refs.xf_name.files;
            //this.files = this.$refs.xf_name.files;

            let uploadedFiles = this.$refs.xf_name.files;
            for (var j = 0; j < uploadedFiles.length; j++) {
                this.files.push(uploadedFiles[j]);
            }
            app.addPicsave();

        },
        addFiles: function () {
            this.$refs.xf_name.click();
        },
        removeFile: function (key) {
            this.files.splice(key, 1);
        },
        insertimg: function (imgf) {
            tinymce.get("elm1").execCommand('mceInsertContent', false, imgf);
        },
        changetitle: function (label1) {
         //   document.getElementById("label1").innerHTML = label1;
            app.pageNum = 1;
        }



    }
});


Vue.component('imgslider', {

    props: ['fpics', 'home_id'],
    template: '	<div><carousel :autoplay="true" :loop="true" :perPageCustom="[[300, 1], [768, 1]]">	<slide  v-for="(fpic,index) in fpics" :key="index" v-if="fpic[2]"><img v-bind:src="/_var/+home_id+/vshop/+fpic[0]" /></slide></carousel></div> ',
    mounted: function () {
    },
    components: {
        'carousel': VueCarousel.Carousel,
        'slide': VueCarousel.Slide
    }
});

