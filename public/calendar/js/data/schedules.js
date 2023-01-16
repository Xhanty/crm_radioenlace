"use strict";

/*eslint-disable*/

var ScheduleList = [];

function ScheduleInfo() {
    this.id = null;
    this.calendarId = null;

    this.title = null;
    this.body = null;
    this.location = null;
    this.isAllday = false;
    this.start = null;
    this.end = null;
    this.category = "";
    this.dueDateClass = "";

    this.color = null;
    this.bgColor = null;
    this.dragBgColor = null;
    this.borderColor = null;
    this.customStyle = "";

    this.isFocused = false;
    this.isPending = false;
    this.isVisible = true;
    this.isReadOnly = false;
    this.isPrivate = false;
    this.goingDuration = 0;
    this.comingDuration = 0;
    this.recurrenceRule = "";
    this.state = "";

    this.raw = {
        memo: "",
        hasToOrCc: false,
        hasRecurrenceRule: false,
        location: null,
        creator: {
            name: "",
            avatar: "",
            company: "",
            email: "",
            phone: "",
        },
    };
}

function printSchedule(printSchedule) {
    var schedule = new ScheduleInfo();

    schedule.id = printSchedule.code;
    schedule.calendarId = String(printSchedule.calendarId);
    schedule.title = printSchedule.name;
    schedule.body = "";
    schedule.location = printSchedule.description;

    if (printSchedule.isAllDay == 0) {
        schedule.isAllday = false;
    } else {
        schedule.isAllday = true;
    }

    schedule.start = moment(printSchedule.start).toDate();
    schedule.end = moment(printSchedule.end).toDate();

    if (schedule.isAllday) {
        schedule.category = "allday";
    } else {
        schedule.category = "time";
    }

    schedule.isReadOnly = false;
    

    if (printSchedule.isPrivate == 0) {
        schedule.isPrivate = false;
    } else {
        schedule.isPrivate = true;
    }

    schedule.state = printSchedule.state;

    schedule.color = printSchedule["category"]["color"];
    schedule.bgColor = printSchedule["category"]["bgColor"];
    schedule.dragBgColor = printSchedule["category"]["dragBgColor"];
    schedule.borderColor = printSchedule["category"]["borderColor"];

    ScheduleList.push(schedule);
}

function generateSchedule(viewName, renderStart, renderEnd) {
    ScheduleList = [];
    var ScheduleList2 = document.getElementById("events_user_all").value;
    ScheduleList2 = JSON.parse(ScheduleList2);
    
    ScheduleList2.forEach((element) => {
        printSchedule(element);
    });

    //console.log(ScheduleList);
}