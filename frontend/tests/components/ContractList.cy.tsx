import { Provider } from 'react-redux'
import { store }  from '../../src/store'
import ContractDetail from '../../src/components/ContractDetail'


describe('ContractDetail.cy.tsx', () => {
  it('%testName%', () => {
    cy.mount(<Provider store={store}><ContractDetail /></Provider>)
  })
})