
export class User {

    id: number = 0;
    name = "";

    language = "english";

    messages = [];
    messageCount = 0;

    constructor(userdata?: User) {
        if (userdata) {
            this.id = userdata.id;
            this.name = userdata.name;

            this.messages = userdata.messages;
            this.messageCount = this.messages.length;

        }
    }

}