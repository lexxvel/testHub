<template>
    <div class="" style="width: 100%">
        <div>
            <div class="dropdown relative" style="width: 100%">
                <button @click="click()"
                    class=" dropdown-toggle
                          px-6 py-2.5 bg-gray-100 text-black font-medium text-xs leading-tight uppercase rounded shadow-md
                          hover:bg-gray-300 hover:shadow-lg  active:bg-gray-600 active:shadow-lg active:text-white
                          transition duration-150 ease-in-out flex items-center whitespace-nowrap
                        "
                    type="button"
                    id="dropdownMenuButton1"
                    data-bs-toggle="dropdown"
                    aria-expanded="true"
                        style="width: 100%; align-items: center; justify-content: center;"
                >
                    {{name}}
                    <svg
                        aria-hidden="true"
                        focusable="false"
                        data-prefix="fas"
                        data-icon="caret-down"
                        class="w-2 ml-2"
                        role="img"
                        xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 320 512"
                    >
                        <path
                            fill="currentColor"
                            d="M31.3 192h257.3c17.8 0 26.7 21.5 14.1 34.1L174.1 354.8c-7.8 7.8-20.5 7.8-28.3 0L17.2 226.1C4.6 213.5 13.5 192 31.3 192z"
                        ></path>
                    </svg>
                </button>
                <ul style="padding-left: 0px; min-height: 20px;height: auto; display:inline-block;"
                    class="dropdown-menu min-w-max absolute bg-white text-base z-50 float-left py-2 list-none text-left rounded-lg
                         shadow-lg mt-1 m-0 bg-clip-padding border-none "
                    aria-labelledby="dropdownMenuButton1"
                >
                    <CaseVersionOption v-if="type === 'versions' && !elementsHidden"
                                        v-for="version in caseVersions"
                                        :key="version.version"
                                       :createDate="formatDateToRussian(version.created_at)"
                                       :author="version.email"
                                       :version="version.version"
                                       :selected="selected"
                                       @select-version="selectItem"
                    ></CaseVersionOption>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
import CaseVersionOption from "./CaseVersionOption";
import * as myMethods from "../../methods";
export default {
    name: "Dropdown",
    components: {
        CaseVersionOption
    },
    props: {
        name: String,
        caseVersions: Object || null,
        type: String,
        selected: Number,
    },
    data: () => ({
        elementsHidden: true
    }),
    methods: {
        click() {
            this.elementsHidden = !this.elementsHidden
        },
        selectItem(id) {
            this.click();
            this.$emit('select-item', id)
        },
        formatDateToRussian(value){
            return myMethods.formatDateToRussian(value)
        }
    }
}
</script>

<style scoped>

</style>
