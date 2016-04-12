package com.example.kathy.sqllite;

/**
 * Created by kathy on 4/12/16.
 */
public class Agenda {
    private int id;
    private String name;
    private int phone;
    private String direction;
    private int age;
    private String color;
    private int height;

    public Agenda(){}

    public Agenda(int id,String name,int phone,String direction,int age,String color, int height){
        this.id= id;
        this.name= name;
        this.phone= phone;
        this.direction = direction;
        this.age= age;
        this.color= color;
        this.height= height;
    }

    public void setId(int id){this.id=id;}
    public void setName(String name){this.name=name;}
    public void setPhone(int phone){this.phone=phone;}
    public void setDirection(String direction){this.direction=direction;}
    public void setAge(int age){this.age= age;}
    public void setColor(String color){this.color=color;}
    public void setHeight(int height){this.height= height;}
    public int getId() {return id;}
    public int getPhone() {return phone;}
    public String getDirection() {return direction;}
    public String getName(){return name;}
    public int getAge(){return age;}
    public String getColor(){return color;}
    public int getHeight(){return height;}
}
