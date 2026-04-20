// let str="hello";
// let letre=str.split("");
// let res="";
// for(let i=str.length-1 ; i>=0 ; i--){
//     res+=str[i];
// }
// console.log(res);

// for(let i=0 ; i<letre.length ; i++){
//     res++;
// } 
// console.log(res);

// for(let i=0 ; i<str.length ; i++){
//     if(str[i]==="e"){
//         res="true";
//         break;
//     }else{
//         res="false";
//     }
// }
// console.log(res);

// let double="";
// for(let i=0; i<str.length ; i++){
//     if(str[i]===str[i+1]){
//         double+=str[i+1];  
//     }else{
//         res+=str[i];
//     }
// }
// console.log(res);
// console.log(double);

// let  str="Le développement web est fascinant";
// let string=str.split("");
// let res="";
// for(let i=0 ; i<string.length ; i++){
//     if(string[i].length>res.length){
//         res=string[i];
//     }
// }
// console.log(res);

// let res=[];
// let char="e";
// let count=0;
// for(let i=0 ; i<str.length ; i++){
//     if(str[i]===char){
//         count++;  
//     }
// }
// console.log(count);


// let str = "Le développement web est fascinant";
// let res = "";
// let double = "";

// for (let i = 0; i < str.length; i++) {
//     if (str[i] === str[i + 1]) {
//         double += str[i]; 
//     } else {
//         res += str[i]; 
//     }
// }

// console.log("Result:", res);
// console.log("Doublons:", double);



// let str="aaabbbccccc";
// let count =1;
// let res="";
// for(let i=0 ; i<str.length ; i++){
//     if(str[i]===str[i+1]){
//         count ++;
//     }else{
//         res+=str[i] + count;
//         count=1;
//     }
// }
// console.log(res);


// --------------*************************----------------------************************--------------------
// let elm1="khaoula";
// let elm2="oualahk";
// if(elm1.length !== elm2.length){
//     console.log(false);
// }else{
//     let count={};
//     let isAnagram=true;
//         for(let i=0 ; i<elm1.length ; i++){
//             let char=elm1[i];

//             if(count[char]){
//                 count[char]++;
//             }else{
//                 count[char]=1;
//             } 
//         }

//         for(let i=0 ; i<elm2.length ; i++){
//             let char=elm2[i];

//             if(!count[char]){
//                 isAnagram=false;
//                 break;
//             }
//             count[char]--;
//         }
//         console.log(isAnagram);
// }
// --------------*************************----------------------************************--------------------

// let str="level";
// let res="";

// for(let i=str.length-1; i>=0 ;i--){
//     res+=str[i];
// }
// if(res===str){
//     console.log(true);
// }else{
//     console.log(false);
// }
// console.log(res);
