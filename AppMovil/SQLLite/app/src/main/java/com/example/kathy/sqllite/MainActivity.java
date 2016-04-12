package com.example.kathy.sqllite;

import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.util.Log;
import android.view.View;
import android.view.Menu;
import android.view.MenuItem;

import java.util.List;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        DBHandler db = new DBHandler(this);

        Log.d("Insert: ", "Inserting ..");
        db.addAgenda(new Agenda(1,"Denver",22345667,"USA",20,"Azul",120));
        db.addAgenda(new Agenda(1,"Milan",86774444,"USA",21,"Amarillo",140));
        db.addAgenda(new Agenda(1,"Martin",666666666,"USA",22,"Anaranjado",160));
        db.addAgenda(new Agenda(1,"Roma",56667733,"USA",23,"Violeta",170));
        db.addAgenda(new Agenda(1,"Pepe",944444442,"USA",24,"Verde",180));
        db.addAgenda(new Agenda(1,"Vito",99440404,"USA",25,"ROjo",190));

        Log.d("Reading: ", "Reading all contacts...");
        List<Agenda> shops = db.getAllShops();

        for (Agenda agenda : shops){
            String log = "Id: " +agenda.getId() + " ,Name: " + agenda.getName() + " ,Phone: "+agenda.getPhone()+",Direction: " +agenda.getDirection() + " ,Age: " + agenda.getAge() + " ,Color: "+agenda.getColor()+ " ,Height: " + agenda.getHeight() ;
            Log.d("Agenda: : ", log);
        }

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });
    }

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.menu_main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();

        //noinspection SimplifiableIfStatement
        if (id == R.id.action_settings) {
            return true;
        }

        return super.onOptionsItemSelected(item);
    }
}
