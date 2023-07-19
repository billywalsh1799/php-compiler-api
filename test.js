console.log("hello from nodejs")
let arguments=process.argv
arguments=arguments.slice(2)
console.log("arguments:",arguments)
for(let i=0;i<1000000000;i++)
    console.log("aaaaaa") 