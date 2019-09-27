<template>
    <q-page v-if="this.loading === false" padding>
        <div class="q-pa-md q-gutter-sm">
            <q-splitter v-model="splitterModel">
                <template v-slot:before>
                    <q-tabs
                        v-model="tab"
                        vertical
                        class="text-teal"
                    >
                        <q-tab name="info" icon="mdi-view-dashboard-outline" label="Participant info" />
                        <q-tab name="pdpa" icon="mdi-card-text-outline" label="PDPA" />
                        <q-tab name="org_detail" icon="mdi-card-text-outline" label="Organisation Detail" />
                        <q-tab name="reg_detail" icon="mdi-card-text-outline" label="Registration Detail" />
                        <q-tab name="exam_info" icon="mdi-card-text-outline" label="Study Exam Info" />
                        <q-tab name="session_and_language" icon="mdi-card-text-outline" label="Session & Language" />
                        <q-tab name="introducer_info" icon="mdi-card-text-outline" label="Introducer Info" />
                        <q-tab name="emergency_contact_info" icon="mdi-card-text-outline" label="Emergency Contact Info" />
                        <q-tab name="training_commitment" icon="mdi-card-text-outline" label="Training Commitment" />
                        <q-tab name="injury_info" icon="mdi-card-text-outline" label="Injury Info" />
                        <q-tab name="health_screening" icon="mdi-card-text-outline" label="Health Screening" />
                        <q-tab name="drugs_n_dietary" icon="mdi-card-text-outline" label="Drugs & Dietary" />
                        <q-tab name="audition_info" icon="mdi-card-text-outline" label="Audition Info" />
                        <q-tab name="costume_measurement" icon="mdi-card-text-outline" label="Costume Measurement" />
                        <q-tab name="official_remarks" icon="mdi-card-text-outline" label="Official Remarks" />
                        <q-tab name="history" icon="mdi-card-text-outline" label="History" />
                    </q-tabs>
                </template>
                <template v-slot:after>
                    <q-tab-panels
                        v-model="tab"
                        animated
                        transition-prev="jump-up"
                        transition-next="jump-up"
                    >
                        <q-tab-panel name="info">
                            <q-card class="relative-position row">
                                <q-card-section class="col-12">
                                    <div class="text-h4 q-mb-md">Participant info</div>
                                </q-card-section>
                                <q-card-section class="col-md-6 col-sm-12">
                                    <q-list>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Name</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().name }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Chinese Name</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().chinesename }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Date of birth</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().dateofbirth }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Gender</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().gender }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </q-list>
                                </q-card-section>
                                <q-card-section class="col-md-6 col-sm-12">
                                    <q-list>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Nationality</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().nationality }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Country of birth</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().countryofbirth }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Race</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().race }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Occupation</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().occupation }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </q-list>
                                </q-card-section>
                            </q-card>
                        </q-tab-panel>
                    </q-tab-panels>
                    <q-tab-panels
                        v-model="tab"
                        animated
                        transition-prev="jump-up"
                        transition-next="jump-up"
                        @before-transition="loadPanel"
                    >
                        <q-tab-panel name="pdpa">
                            <q-card class="relative-position row">
                                <q-card-section class="col-12">
                                    <div class="text-h4 q-mb-md">PDPA</div>
                                </q-card-section>
                                <q-card-section class="col-md-6 col-sm-12">
                                    <q-list>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Nric</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().nric }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Email</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().email }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Phone</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().tel }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Mobile</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().mobile }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </q-list>
                                </q-card-section>
                                <q-card-section class="col-md-6 col-sm-12">
                                    <q-list>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Address</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().address }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Building name</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().buildingname }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Unit No.</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().unitno }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Postal code</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().postalcode }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </q-list>
                                </q-card-section>
                            </q-card>
                        </q-tab-panel>
                        <q-tab-panel name="org_detail">
                            <q-card class="relative-position row">
                                <q-card-section class="col-12">
                                    <div class="text-h4 q-mb-md">Organisation Detail</div>
                                </q-card-section>
                                <q-card-section class="col-md-6 col-sm-12">
                                    <q-list>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>RHQ</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().rhq }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Zone</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().zone }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Chapter</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().chapter }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </q-list>
                                </q-card-section>
                                <q-card-section class="col-md-6 col-sm-12">
                                    <q-list>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>District</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().district }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Position</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().position }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Position Level</q-item-label>
                                                <q-item-label lines="2">--</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </q-list>
                                </q-card-section>
                            </q-card>
                        </q-tab-panel>
                        <q-tab-panel name="reg_detail">
                            <q-card class="relative-position row">
                                <q-card-section class="col-12">
                                    <div class="text-h4 q-mb-md">Registration Detail</div>
                                </q-card-section>
                                <q-card-section class="col-md-6 col-sm-12">
                                    <q-list>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Role</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().role }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Item</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().item }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>SSA Group</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().ssagroup }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Contact Group</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().contactgroup }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </q-list>
                                </q-card-section>
                                <q-card-section class="col-md-6 col-sm-12">
                                    <q-list>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>SSA Group All</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().ssagroupall }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Audition Code</q-item-label>
                                                <q-item-label lines="2">{{ currentMember().auditioncode }}</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Group Code Prefix & Group Code</q-item-label>
                                                <q-item-label lines="2">--</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                        <q-item>
                                            <q-item-section>
                                                <q-item-label caption>Registration Status</q-item-label>
                                                <q-item-label lines="2">--</q-item-label>
                                            </q-item-section>
                                        </q-item>
                                    </q-list>
                                </q-card-section>
                            </q-card>
                        </q-tab-panel>
                    </q-tab-panels>
                </template>
            </q-splitter>
        </div>
        <q-page-sticky position="bottom-right" :offset="[18, 18]">
            <q-btn v-if="allowed('create') && isEditMode === false" fab color="primary" :disable="loading" icon="mdi-pencil" @click="editParticipant" class="q-mr-sm"/>
            <q-btn v-if="allowed('create') && isEditMode === true" fab color="red" :disable="loading" icon="mdi-check" @click="saveParticipant" class="q-mr-sm"/>
            <q-btn v-if="allowed('create') && isEditMode === true" fab color="grey" :disable="loading" icon="mdi-cancel" @click="cancelEdit" class="q-mr-sm"/>
        </q-page-sticky>
    </q-page>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
  name: 'Participant',
  data () {
    return {
      loading: true,
      splitterModel: 20,
      tab: 'info',
      participant: {},
      member: {},
      isEditMode: false
    }
  },
  beforeRouteEnter (to, from, next) {
    next(vm => {
      vm.loadPanel('info', '')
    })
  },
  computed: {
    allowed (arr) {
      return this.userCan(arr)
    }
  },
  methods: {
    ...mapActions(['loadParticipant']),
    ...mapGetters(['currentMember', 'userCan']),
    loadPanel (next, prev) {
      this.loadParticipant(this.$route.params).then((resp) => {
        this.participant = resp.participant
        this.member = resp.member
        this.loading = false
      })
    },
    editParticipant () {},
    saveParticipant () {},
    cancelEdit () {}
  }
}
</script>
