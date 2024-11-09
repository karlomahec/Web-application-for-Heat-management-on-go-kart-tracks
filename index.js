const express = require('express');
const { google } = require('googleapis');
const bodyParser = require('body-parser');  

const app = express();
  
const SCOPES = 'https://www.googleapis.com/auth/calendar';
const GOOGLE_PRIVATE_KEY="-----BEGIN PRIVATE KEY-----\nMIIEvgIBADANBgkqhkiG9w0BAQEFAASCBKgwggSkAgEAAoIBAQC18MiV8OQmzt5k\nG5aGlM0nehkL5kmK8dSGQc7MdUk8pduYCHukShLHMULXY+YB80QJs6L9MqUUh/eZ\nG7vBdkKsDnxTaWA9vZ6QDiFW35z3PboroXCsjstp275I6ANemkmtVnVDL6a6mfhV\nVHh2Mxd57ew4sMxbxKfBJXX/YXx4iaA94BL7FUgAzsbbqBhw9SGgFDwzog4hATby\nIiLoLbz9LHypwDtSOXJ/E4vxq6cPcCurmg5+HHJN50pYVQa8ygNohTIvz/xlfJep\nPcUwav0h8Nmy4XejOqOo61vnclHcAXdSrRpW84gs4P5qq52ZOY1j4lXhP+NUhMLr\nt0LiLt01AgMBAAECggEAAt4luz9NyVLPbJKGv95OkYW6KVba5+bB68/Tu6NJoTwY\nBwBzOna0bxFWtWBsurEj7Gc5dXY75ePywiYOwpDjoiSkTwhFLRP1EN44Jk9mAPun\nGJL13LJvgF6nVCzcCLyz1pibRpDUtvJAWM/5ChvqDdDzPT2EKxohbsjxYDIgLSIv\nYYhO2P3pPe9nyk/kau12aa0y0MSwPIkFXA2j4GKoivuGCznOhpmoj0hFpyP8aYL6\nD9hgnv8+Cd9UECNWEGwsZbbSx3PJDzW/P3tND+hu9MKOkvCuZkXJbHGmSrN0ysYC\njLvjukwH2TbtyS9VYdKuidnwhdijFhpc0ze7JSBNLQKBgQDqxa2wLxpOrS4BnqNc\n9wPFyuiZgN37ONlJx7FbArsbtK3pLdA0i3NCEFLo/OKErfgBm/YVfvFBhOm7lTvi\n5zn9USXsn/35DtJuBpTUjjf1ignvyVMVNeUZiCRbxhDtMSEtyz7wIXrMjcZOYIG+\n9kEtSNcDrfjoSri4g00HYecj5wKBgQDGZDNIdBA6irta/iaAyYX3rZ2C/D5/Jkuj\ni1bG5g8F/ORso2DY1BxkPfkn7yzemh/MLkL1bzfSFrcxN7kuzFWVHMUBGDr2c/Sk\nvwX8ei1dC0KGaZ3pv9AJ8mqg4UHMMzoqnWCrB683uDB+8VoN7opAv3q/ivdyThWp\nXZ7tuGzSgwKBgQClQ96OpbnJJJO8RCYPrTsUo0+1r0eUL2KWU2KABJ4eVMQP31Yv\nhvLt0Hvs0wfKCoUI7PcADspaKuw2RklP4yGpNtSRi9bG2i47kZp3Pl4aFMAF8hzw\nU24g2PtvNzB3KByJFggKFidRk4PDbKApA0TCUgI57t/G9cKu8I7q4XpKhQKBgC6l\nRo2FhH9POSf207S6LT6D2qH+ju80YNpuG5QeaW/d+xM0AsRYcuh6zcc+7AzWrh1C\nz0mHwdcqsh3nXSoMrx6lKgjM2qgxsVa+9zhavam/yP9ze8aG6/I6xilXbTIG5Wk5\noY30+5SdQQHH24WlDWqV2tWIZg/BHkS5F3ILR8LjAoGBALQNou6lKC85Q81cp4aq\nPZ6fyYRJKkX/boVQqzD4/O2oUJllmkTLEdP15ExpBiDllxZFk89VVm10mID8C8qE\nPrG6JqNpMbRPYe6A9WSNzFZhYfrbZjKRr8YYoah8WbREyjgsNgOrQzKvocti58SM\nbnXWbQGS0oCAGSrECRsdxWY6\n-----END PRIVATE KEY-----\n"
const GOOGLE_CLIENT_EMAIL = "calendar-key@seismic-relic-390010.iam.gserviceaccount.com"
const GOOGLE_PROJECT_NUMBER = "501470139855"
const GOOGLE_CALENDAR_ID = "93e10d3b00fc34861f968fb617b6f3bd419f62026cd77128b7f44c34fdd059ec@group.calendar.google.com"
  
const jwtClient = new google.auth.JWT(
    GOOGLE_CLIENT_EMAIL,
    null,
    GOOGLE_PRIVATE_KEY,
    SCOPES
);
  
const calendar = google.calendar({
    version: 'v3',
    project: GOOGLE_PROJECT_NUMBER,
    auth: jwtClient
});
  
app.get('/', (req, res) => {
    calendar.events.list({
      calendarId: GOOGLE_CALENDAR_ID,
      timeMin: (new Date()).toISOString(),
      maxResults: 10,
      singleEvents: true,
      orderBy: 'startTime',
    }, (error, result) => {
      if (error) {
        res.send(JSON.stringify({ error: error }));
      } else {
        if (result.data.items.length) {
          res.send(JSON.stringify({ events: result.data.items }));
        } else {
          res.send(JSON.stringify({ message: 'No upcoming events found.' }));
        }
      }
    });
  });

  app.use(bodyParser.urlencoded({ extended: false }));

app.post("/createEvent",(req,res)=>{
    const formData = req.body;

    // Extract form data
    const emailContact = formData['e-contact'];
    const numberPeople = formData['number'];
    const selectedPackage = formData['country'];
    const eventStart = formData['event-start'];
    const phoneNumber = formData['contact'];
    const eventDate = formData['event-date'];

    console.log(numberPeople);

    const event = {
        'summary': `Event for ${numberPeople} people (${selectedPackage})`,
        'location': 'Zagreb, Croatia',
        'description': `Event for ${numberPeople} people with the ${selectedPackage} package. Contact: ${emailContact}, Phone: ${phoneNumber}`,
        'start': {
            'dateTime': `${eventDate}${eventStart}:00+07:00`,
            'timeZone': 'Europe/Berlin',
        },
        'end': {
            'dateTime': `${eventDate}${eventStart}:00+07:00`,
            'timeZone': 'Europe/Berlin',
        },
        'attendees': [],
        'reminders': {
            'useDefault': false,
            'overrides': [
                {'method': 'email', 'minutes': 24 * 60},
                {'method': 'popup', 'minutes': 10},
            ],
        },
    };
    
    const auth = new google.auth.GoogleAuth({
        scopes: 'https://www.googleapis.com/auth/calendar',
        keyFile: 'C:/Users/User/Desktop/zavrshni/seismic-relic-390010-69423f3e809f.json'
    });
    auth.getClient().then(a=>{
      calendar.events.insert({
        auth:a,
        calendarId: GOOGLE_CALENDAR_ID,
        resource: event,
      }, function(err, event) {
        if (err) {
          console.log('There was an error contacting the Calendar service: ' + err);
          return;
        }
        console.log('Event created: %s', event.data);
        res.jsonp("Event successfully created!");
      });
    })
});
  
app.listen(3000, () => console.log(`App listening on port 3000!`));