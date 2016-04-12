package com.example.kathy.sqllite;

import android.content.ContentValues;
import android.content.Context;
import android.content.Intent;
import android.database.Cursor;
import android.database.sqlite.SQLiteDatabase;
import android.database.sqlite.SQLiteOpenHelper;

import java.util.ArrayList;
import java.util.List;

/**
 * Created by kathy on 4/12/16.
 */
public class DBHandler extends SQLiteOpenHelper {
    //Database Version
    private static final int DATABASE_VERSION=1;
    //Database Name
    private static final String DATABASE_NAME = "agendaInfo";
    //Contacts table name
    private static final String TABLE_AGENDA = "agenda";
    //Shops Table Columns names
    private static final String KEY_ID= "id";
    private static final String KEY_NAME= "name";
    private static final String KEY_PHONE= "phone";
    private static final String KEY_DIRECTION= "direction";
    private static final String KEY_AGE= "age";
    private static final String KEY_COLOR= "color";
    private static final String KEY_HEIGHT= "height";

    public DBHandler(Context context){super(context,DATABASE_NAME,null,DATABASE_VERSION);}

    @Override
    public void onCreate(SQLiteDatabase db) {
        String CREATE_AGENDA_TABLE = "CREATE TABLE " + TABLE_AGENDA +
                "(" + KEY_ID + " INTEGER PRIMARY KEY, "
                    + KEY_NAME + " TEXT, "
                    + KEY_PHONE + " INTEGER, "
                    + KEY_DIRECTION + " TEXT, "
                    + KEY_AGE +  " INTEGER, "
                    + KEY_COLOR + " TEXT, "
                    + KEY_HEIGHT + " INTEGER"  + ")";
        db.execSQL(CREATE_AGENDA_TABLE );
    }

    @Override
    public void onUpgrade(SQLiteDatabase db, int oldVersion, int newVersion) {
        db.execSQL("DROP TABLE IF EXISTS " + TABLE_AGENDA);
        onCreate(db);
    }

    //adding new agenda
    public void  addAgenda (Agenda agenda){
        SQLiteDatabase db= this.getWritableDatabase();
        ContentValues values= new ContentValues();
        values.put(KEY_NAME,agenda.getName());
        values.put(KEY_PHONE, agenda.getPhone());
        values.put(KEY_DIRECTION, agenda.getDirection());
        values.put(KEY_AGE, agenda.getAge());
        values.put(KEY_COLOR, agenda.getColor());
        values.put(KEY_HEIGHT, agenda.getHeight());

        //Inserting Row
        db.insert(TABLE_AGENDA,null,values);
        db.close();
    }

    //Getting one shop
    public Agenda getAgenda(int id){
        SQLiteDatabase db= this.getReadableDatabase();
        Cursor cursor = db.query(TABLE_AGENDA, new String[]{ KEY_ID, KEY_NAME,KEY_PHONE,KEY_DIRECTION,KEY_AGE,KEY_COLOR,KEY_HEIGHT}, KEY_ID + "=?", new String[]{String.valueOf(id),},null,null,null,null);
        if(cursor!=null){
            cursor.moveToFirst();
        }
        Agenda agenda= new Agenda(Integer.parseInt(cursor.getString(0)),
                cursor.getString(1),Integer.parseInt(cursor.getString(2)),cursor.getString(3),Integer.parseInt(cursor.getString(4)),cursor.getString(5),Integer.parseInt(cursor.getString(6)));

        return agenda;
    }

    public List<Agenda> getAllShops(){
        List<Agenda> shopList = new ArrayList<>();
        String selectQuery = "SELECT * FROM " + TABLE_AGENDA;
        SQLiteDatabase db = this.getWritableDatabase();
        Cursor cursor = db.rawQuery(selectQuery, null);

        if (cursor.moveToFirst()){
            do {
                Agenda agenda = new Agenda();
                agenda.setId(Integer.parseInt(cursor.getString(0)));
                agenda.setName(cursor.getString(1));
                agenda.setPhone(Integer.parseInt(cursor.getString(2)));
                agenda.setDirection(cursor.getString(3));
                agenda.setAge(Integer.parseInt(cursor.getString(4)));
                agenda.setColor(cursor.getString(5));
                agenda.setHeight(Integer.parseInt(cursor.getString(6)));


                shopList.add(agenda);
            }while (cursor.moveToNext());

        }

        return shopList;
    }

    public int  getShopsCount(){
        String countQuery= "SELECT * FROM "+ TABLE_AGENDA;
        SQLiteDatabase db = this.getReadableDatabase();
        Cursor cursor= db.rawQuery(countQuery, null);
        cursor.close();
        return cursor.getCount();
    }

    public int updateShop(Agenda agenda){
        SQLiteDatabase db= this.getWritableDatabase();
        ContentValues values = new ContentValues();
        values.put(KEY_NAME, agenda.getName());
        values.put(KEY_PHONE,agenda.getPhone());
        values.put(KEY_DIRECTION, agenda.getDirection());
        values.put(KEY_AGE,agenda.getAge());
        values.put(KEY_COLOR, agenda.getColor());
        values.put(KEY_HEIGHT, agenda.getHeight());

        return db.update(TABLE_AGENDA, values, KEY_ID + " =?", new String[]{String.valueOf(agenda.getId())});

    }

    public void deleteShop(Agenda agenda){
        SQLiteDatabase db= this.getWritableDatabase();
        db.delete(TABLE_AGENDA, KEY_ID+ " =?",new String[]{String.valueOf(agenda.getId())});
        db.close();
    }
}
