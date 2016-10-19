
export class NavigationEntry {

    constructor(
        public label: string,
        public route: string,
        public icon?: string,
        public children?: NavigationEntry[]
    ) {

    }

}

export class NavigationCategory {

    constructor(
        public label: string,
        public icon?: string,
        public children?: NavigationEntry[]
    ) {

    }
}

export class Navigation {

    constructor(
        public children?: any[]
    ) {

    }

    getChildren(): NavigationEntry[] {
        return this.children;
    }

    addEntry(entry: NavigationEntry) {
        this.children.push(entry);
    }

    addCategory(category: NavigationCategory) {
        this.children.push(category);
    }
}
