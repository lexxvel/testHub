<template>
    <div>

    <div
            :class="{bold: isFolder}"
            @click="toggle"
            style="width: 100%; height: auto; display: flex"
            >
            <div v-if="!editFolder" style="width: 100%; height: auto; display: flex" >
                <a @click="openFolder" style="text-decoration: none; color: #1a202c" ><span style="margin: 0 0 0 0; height: 24px; float: left" v-if="isFolder">[{{ isOpen ? '-' : '+' }}]</span></a>
                <p :class="{selected: isSelected}" @dblclick="edit" style="margin: 0 0 0 0; float: left; height: 24px; max-width: 100%; overflow: hidden">
                    <a> {{item.name}} </a>
                </p>

                <a @click="makeFolder(item)" v-if="!isFolder && !viewOnly && User_Role > 0" style="float: left; padding-left: 5px; opacity: .4; height: 80%; width: 17px;"><img style="padding-top:5px; padding-bottom:5px;"  src="/img/tree/folderAddSmall.png"></a>
                <a @click="deleteFolder(parent, item.id)" v-if="!isFolder && !item.root && !viewOnly && User_Role > 0" style="float: left; padding-left: 4px; opacity: .4; height: 80%; width: 17px;"><img  style="padding-top:7px; padding-bottom:5px;" src="/img/tree/мусорка.svg"></a>
            </div>
            <input v-if="editFolder" style="height: 23px; width: 160px" type="text" v-model="newName" ><a @click="renameFolder" v-if="editFolder" style="float: left">🆗</a>

        </div>

        <ul v-show="isOpen" v-if="isFolder" style="margin: 0 0 0 0">
            <tree-item
                class="item"
                v-for="(child, index) in item.children"
                :key="index"
                :item="child"
                :parent="item"
                :selected="selected"
                :view-only="viewOnly"
                @make-folder="$emit('make-folder', $event)"
                @add-item="$emit('add-item', $event)"
                @select-item="$emit('select-item', $event)"
                @item-is-selected="$emit('item-is-selected', $event)"
                @rename-folder="$emit('rename-folder', $event)"
                @delete-folder="$emit('delete-folder', $event)"
            ></tree-item>
            <li v-if="!viewOnly && User_Role > 0" style="height: 18px; width: 18px" class="add" @click="$emit('add-item', item)"><a ><img style="opacity: .4; height: 20px; width: 20px" src="/img/tree/folderAddSmall.png"></a></li>
        </ul>

    </div>
</template>

<script>
export default {
    name: "TreeItem",
    props: {
        item: Object,
        selected: null,
        parent: Object,
        project: Number || null,
        viewOnly: Boolean || null,
        User_Role: Number || null,
    },
    data: function() {
        return {
            isOpen: true,
            editFolder: false,
            newName: ""
        };
    },
    computed: {
        isFolder: function() {
            return this.item.children && this.item.children.length;
        },
        isSelected: function () {
            return this.$props.selected === this.item.id
        }
    },
    methods: {
        toggle: function() {
            this.$emit('select-item', this.item.id)
        },
        openFolder: function () {
            if (this.isFolder) {
                this.isOpen = !this.isOpen;
            }
        },
        makeFolder: function() {
            if (!this.isFolder) {
                this.$emit("make-folder", this.item);
                this.isOpen = true;
            }
        },
        edit: function () {
            if (!this.item.root) {
                this.editFolder = true;
                this.newName = this.item.name;
            }
        },
        renameFolder: function () {
            if (this.newName !== '' || this.newName !== null) {
                this.$emit("rename-folder", {
                    item: this.item,
                    newName: this.newName
                });
                this.editFolder = false;
                this.newName = "";
            }
        },
        deleteFolder: function (parent, ident) {
            if (parent !== undefined &&  ident !== null) {
                this.$emit("delete-folder", {
                    parent: parent,
                    ident: ident
                });
            }
        }
    }
}
</script>

<style scoped>
.bold {

}

.selected {
    background-color: #ECECECE2;
}
</style>
