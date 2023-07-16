class Solution{
    
    public static void display(){
        System.out.println("solution class method executed ");
    }
}


class Main {
    public static void main(String[] args) {
        System.out.println("Hello from java");
        Solution.display();
        for(String arg: args){
            System.out.println("argument:"+arg+" length:"+arg.length());
        }
    }
}